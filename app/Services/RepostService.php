<?php
namespace App\Services;

use App\Feed;
use App\Hashtag;
use App\PostHashtag;
use Illuminate\Http\Request;
use App\Repost;



class RepostService
{
    public function handleRepost(){

        $feed_id = request()->feed_id;
        $post_id = request()->post_id;
        $feed = Feed::findOrFail($feed_id);
        $user = auth()->user();
        $status = request()->status;
        $thought = request()->repost_message;
        

        if($thought !== null){
            
            $post_repost = Feed::create(['user_id' => $user->id, 'post_id' => $post_id, 'status' => 'rwc', 'repost_message' => $thought]);
            $post_repost->id;
            $repost = Repost::create(['feed_id' => $feed_id, 'user_id' => $user->id, 'status' => $status]);
            $repost->load('feed.user.profile.photo');
            

            $postWithHashtags = Feed::where(["id" => $post_repost->id])->first();
            // $postWithHashtags = Repost::where(["id" => $repost->id])->first();
            

            
            $thought = str_replace("#", " #", $thought);
            $thought = str_replace("<", " <", $thought);
            $thought = str_replace(">", "> ", $thought);
    

            $tags = getHashTags($thought);
    
            if (count($tags) > 0) {
                foreach ($tags as $tag) {
                    $tag = str_replace('.', '', $tag);
                        $t = $tag;
                    $findHashTag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();
    
                    if ($findHashTag) {
                        PostHashtag::create(['feed_id' => $post_repost->id, 'hashtag_id' => $findHashTag->id]);
                    } else {
    
                        $hashtag = Hashtag::create(['hashtag' => $t]);
                        PostHashtag::create(['feed_id' => $post_repost->id, 'hashtag_id' => $hashtag->id]);
                    }
    
                    $findHashtag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();
                    
                    $hashtagUrl = str_replace("#", "", $findHashtag->hashtag);
                    $anchoredHashtag = str_replace($t, "<a href='/hashtag/" . $hashtagUrl . "'>" . $t . "</a>", $postWithHashtags->repost_message);
                    $postWithHashtags->update(['repost_message' => $anchoredHashtag]);
                }
            }

            return $repost;


        } else {
            Feed::where('id', $feed_id)->increment('shares');
            $post_repost = Feed::create(['user_id' => $user->id, 'post_id' => $post_id, 'status' => 'Reposted', 'repost_message' => $thought]);
            $post_repost->id;
            $repost = Repost::create(['feed_id' => $feed_id, 'user_id' => $user->id, 'status' => $status]);
            
            
        }

    }

    

    public function repostUpdate(){

        $id = request()->id;
        $thought = request()->thought;

        
        Feed:: where(['id' => $id])->update(['thought' => $thought]);

        
    }

    public function repostDelete(){


        $user_id = request()->user_id;
        $feed_id = request()->feed_id;


        $repost = Repost::where(['post_look_up_id' => $post_look_up_id, 'user_id' => $user_id])->first();
        
        $deleted_post = Feed::where(['id' => $repost->post_look_up_ref])->delete();
        $deleted_repost = Repost::where(['feed_id' => $feed_id, 'user_id' => $user_id])->delete();
        return $deleted_repost;

        

        
    }

    public function getAllReposts($user) {

        return Feed::where(['user_id' => $user->id, 'status' => 'Reposted'])->get();
    }

    public function getPostReposts($id){

        return Repost::where(['post_look_up_id' => $id])->with('user.profile', 'post_look_up')->distinct()->get();
        
    }


    
}
