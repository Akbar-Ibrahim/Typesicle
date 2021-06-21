<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Post;
use App\Draft;
use App\Category;
use App\Events\NewPostEvent;
use App\Feed;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Photo;
use App\Hashtag;
use App\User;
use App\Mail\NewPost;
use App\Notification;
use App\PostHashtag;
use App\PostPhoto;
use App\PostReply;



class PostService
{



    public function insertPost($request)
    {

        $user = auth()->user();

        $input = $request->all();

        if ($cover_image = $request->file('photo_id')) {
            $request->cover_photo = "";
            $image_name = time() . '_' .$cover_image->getClientOriginalName();

            $cover_image->storePubliclyAs($user->id . '/', $image_name, ['disk' => 'public']);
            $photo = Photo::create(['photo' => $image_name, 'user_id' => auth()->user()->id]);
            $input['photo_id'] = $photo->id;

        }

        if ($cover_image = Photo::where(['photo' => str_replace('/images/' . auth()->user()->id . '/', '', $request->cover_photo)])->first()) {
            $input['photo_id'] = $cover_image->id;
        }

        

        if (request()->has('draft_id')) {
            $draft = Draft::where(['id' => request()->draft_id])->first();
            if ($draft->photo) {
                $input['photo_id'] = $draft->photo_id;
            }
        }

        
        $body = $input['body'];
        $body = str_replace("#", " #", $body);
        $body = str_replace("<", " <", $body);
        $body = str_replace(">", "> ", $body);


        $detail = request()->input('body');
        $dom = new \DomDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name = "/images/" . auth()->user()->id . '/' . time() . $k . '.png';
            $postPhoto = Photo::create(['photo' => str_replace('/images/' . auth()->user()->id . '/', '', $image_name), 'user_id' => auth()->user()->id]);
            PostPhoto::create(['user_id' => auth()->user()->id, 'photo_id' => $postPhoto->id]);


            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $detail = $dom->saveHTML();
        // dd($detail);

        $input['url'] = $request->title;
        $input['category_id'] = $request->category_id;
        $input['user_id'] = $user->id;
        

        $post = Post::create($input);

        if (request()->draft_id) {
            $draft = request()->draft_id;
            Draft::where('id', $draft)->delete();
        }


            $feed = Feed::create(['user_id' => $user->id, 'post_id' => $post->id, 'status' => 'Post Original', 'category_id' => $post->category_id]);
            // $postPhoto->update(['feed_id' => $feed->id]); 

        

        $postWithHashtags = Post::where(['id' => $post->id])->first();

        $tags = getHashTags($body);

        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $tag = str_replace('.', '', $tag);
                $tag = str_replace('<br></p>', '', $tag);
                
                    $t = $tag;
                $findHashTag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();

                if ($findHashTag) {
                    // $findHashTag->feed()->attach(['feed_id' => $feed->id]);
                    PostHashtag::create(['feed_id' => $feed->id, 'hashtag_id' => $findHashTag->id]);
                } else {

                    $hashtag = Hashtag::create(['hashtag' => $t]);
                    // $hashtag->feed()->attach(['feed_id' => $feed->id]);
                    PostHashtag::create(['feed_id' => $feed->id, 'hashtag_id' => $hashtag->id]);
                }

                $findHashtag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();
                
                $hashtagUrl = str_replace("#", "", $findHashtag->hashtag);
                $anchoredHashtag = str_replace($t, "<a href='/hashtag/" . $hashtagUrl . "'>" . $t . "</a>", $postWithHashtags->body);
                $postWithHashtags->update(['body' => $anchoredHashtag]);
            }
        }

        // $recipient = User::where(["id" => 15])->first();
        // $recipient_address = $recipient;
        // $author = $user->name;
        // $post = $feed;
        // $url = route('home:post', [$user->username, $feed->post->url, $feed->id]);

        // $recipient_address->notify(new NewPost($author, $post, $url));

        $recipient = User::where(["id" => 8])->first();

        Mail::to($recipient)->send(new NewPost($post, $recipient));
        
        Notification::create(["user_id" => $recipient->id, "type" => "post", "notifier" => auth()->user()->id, "message" => "has published a new post", "read" => "no", "feed_id" => $feed->id]);
        $myNotifications = Notification::where(["user_id" => $recipient->id, "read" => "no"])->get();
        
        $count = $myNotifications->count();
        broadcast(new NewPostEvent($count, $recipient->id))->toOthers();
    }

    public function updatePost($id)
    {
        $post = Post::findOrFail($id);

        $feed = Feed::where(['post_id' => $post->id])->first();

        
        $input = [
            'title' => request()->title,
            'url' => request()->title,
            'category_id' => request()->category_id,
            'body' => request()->body,
            'photo_id' => request()->photo_id,
        ];

        if ($file = request()->file('photo_id')) {
            request()->cover_photo = "";

            $name = time() . $file->getClientOriginalName();
            $file->move('images/' . auth()->user()->id . '/', $name);
            $photo = Photo::create(['photo' => $name, 'user_id' => auth()->user()->id]);
            $input['photo_id'] = $photo->id;
        }

        if ($cover_image = Photo::where(['photo' => str_replace('/images/' . auth()->user()->id . '/', '', request()->cover_photo)])->first()) {
            $input['photo_id'] = $cover_image->id;
        }

        if ($cover_image = Photo::where(['photo' => request()->cover_photo])->first()) {
            $input['photo_id'] = $cover_image->id;
        }

        $user = auth()->user()->posts()->whereId($id)->first();


        $user->update($input);

        $body = $input['body'];
        $body = str_replace("#", " #", $body);
        $body = str_replace("<", " <", $body);
        $body = str_replace(">", "> ", $body);

        
        $postWithHashtags = Post::where(['id' => $post->id])->first();

        $tags = getHashTags($body);
        
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $tag = str_replace('.', '', $tag);

                $findHashTag = Hashtag::where('hashtag', 'like', "%{$tag}%")->first();

                if ($findHashTag) {
                    // $findHashTag->posts()->attach(['post_look_up_id' => $post_look_up->id]);
                    $hashtagUrl = str_replace("#", "", $findHashTag->hashtag);
                    $anchoredHashtag = str_replace($findHashTag->hashtag, "<a href='/hashtag/" . $hashtagUrl . "'>" . $findHashTag->hashtag . "</a>", $postWithHashtags->body);
                    $postWithHashtags->update(['body' => $anchoredHashtag]);
                } else {

                    $hashtag = Hashtag::create(['hashtag' => $tag]);
                    PostHashtag::create(['feed_id' => $post->feed->id, 'hashtag_id' => $hashtag->id]);

                    $hashtagUrl = str_replace("#", "", $hashtag->hashtag);
                    $anchoredHashtag = str_replace($hashtag->hashtag, "<a href='/hashtag/" . $hashtagUrl . "'>" . $hashtag->hashtag . "</a>", $postWithHashtags->body);
                    $postWithHashtags->update(['body' => $anchoredHashtag]);
                }


            }
        } 


        // session()->flash('post_edit', 'The post has been edited');


    }

    public function deletePost($id)
    {

        $post = Post::findOrFail($id);

        if ($post->photo) {
            unlink(public_path() . $post->photo->file);
        }

        $post->delete();

        Feed::where(['post_id' => $post->id])->delete();
    }



    
}

?>