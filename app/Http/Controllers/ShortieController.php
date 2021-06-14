<?php

namespace App\Http\Controllers;

use App\Events\ShortieReplyEvent;
use App\Feed;
use App\Hashtag;
use App\Photo;
use App\PostHashtag;
use App\Services\PostUtilService;
use App\Services\ShortieService;
use App\Shortie;
use App\ShortiePhoto;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ShortieController extends Controller
{
    //
    public function create(Request $request)
    {

        $shortie = Shortie::where(['id' => $request->quoted])->with('user', 'feed', 'shortiePhoto.photo')->first();

        return view('shortie.create', compact('shortie'));
    }


    public function recentShorties($id, ShortieService $shortieService)
    {
        return $shortieService->recentShorties($id);
    }

    public function getShortie(ShortieService $shortieService)
    {

        return $shortieService->shortie();
    }

    public function getShortiePhotos(ShortieService $shortieService, $shortie_id)
    {

        return $shortieService->getShortiePhotos($shortie_id);
    }

    public function storeShortie(Request $request)
    {

        $shorties = $request->except(['_token']);
        $myShorties = count($shorties);
        $count = $request->count;
        $data = $request->all();
        //    return $myShorties; 

        // return $request->all();

        $shortie_text = $request->shortie;
        $user = auth()->user();

        if ($count > 3) {
            $thread = Thread::create(['user_id' => $user->id]);
        }

        $body = "";

        if ($request->isEmpty == "No") {
            for ($i = 0; $i < $count; $i++) {

                $body = $shorties['shortie' . $i];
                $body = str_replace("#", " #", $body);
                $body = str_replace("<p><br></p>", "", $body);
                $body = str_replace("<", " <", $body);
                $body = str_replace(">", "> ", $body);

                if ($request->has('quoted') && $request->quoted > 0) {
                    if ($count > 3) {
                        if ($i == 0) {
                            $shortie = Shortie::create(['shortie' => $body, 'user_id' => auth()->user()->id, 'quoted' => $request->quoted, 'thread_id' => $thread->id]);
                        } else {
                            $shortie = Shortie::create(['shortie' => $body, 'user_id' => auth()->user()->id, 'thread_id' => $thread->id]);
                        }
                    } else {
                        $shortie = Shortie::create(['shortie' => $body, 'user_id' => auth()->user()->id, 'quoted' => $request->quoted]);
                    }
                } else {
                    if ($count > 3) {
                        $shortie = Shortie::create(['shortie' => $body, 'user_id' => auth()->user()->id, 'thread_id' => $thread->id]);
                    } else {
                        $shortie = Shortie::create(['shortie' => $body, 'user_id' => auth()->user()->id]);
                    }
                }
                if ($count > 3) {
                    if ($i == 0) {
                        $feed = Feed::create(['user_id' => $user->id, 'status' => 'Thread', 'shortie_id' => $shortie->id, 'thread_id' => $thread->id]);
                    } else {
                        $feed = Feed::create(['user_id' => $user->id, 'status' => 'Thread', 'shortie_id' => $shortie->id]);
                    }
                } else {
                    $feed = Feed::create(['user_id' => $user->id, 'status' => 'Shortie', 'shortie_id' => $shortie->id]);
                }


                $shortieWithHashtags = Shortie::where(['id' => $feed->shortie_id])->first();


                // $tags = getHashTags($shorties['shortie' . $i]);
                $tags = getHashTags($body);

                if (count($tags) > 0) {
                    foreach ($tags as $tag) {
                        $tag = str_replace('.', '', $tag);
                        $tag = str_replace('<br></p>', '', $tag);

                        $t = $tag;
                        $findHashTag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();

                        if ($findHashTag) {
                            PostHashtag::create(['feed_id' => $feed->id, 'hashtag_id' => $findHashTag->id]);
                        } else {

                            $hashtag = Hashtag::create(['hashtag' => $t]);
                            PostHashtag::create(['feed_id' => $feed->id, 'hashtag_id' => $hashtag->id]);
                        }

                        $findHashtag = Hashtag::where('hashtag', 'like', "%{$t}%")->first();

                        $hashtagUrl = str_replace("#", "", $findHashtag->hashtag);
                        $anchoredHashtag = str_replace($t, "<a href='/hashtag/" . $hashtagUrl . "'>" . $t . "</a>", $shortieWithHashtags->shortie);
                        $shortieWithHashtags->update(['shortie' => $anchoredHashtag]);
                    }
                }


                if ($uploadFile1 = $request->file($i . 'uploadFile1')) {
                    $countOne = $data[$i . 'count1'];
                    for ($j = 1; $j <= $countOne; $j++) {
                        foreach ($uploadFile1 as $key => $value) {

                            // if ($request->input($j . 'skip1'j)) {
                            if ($key == $data[$i . 'skip' . $j]) {
                                unset($uploadFile1[$key]);
                            }
                            // }
                        }
                    }

                    foreach ($uploadFile1 as $key => $value) {
                        $name = time() . $key . $value->getClientOriginalName();
                        $value->move('images/' . $user->id . '/', $name);
                        $photo = Photo::create(['photo' => $name, 'user_id' => $user->id]);
                        ShortiePhoto::create(['user_id' => $user->id, 'shortie_id' => $shortie->id, 'photo_id' => $photo->id]);
                    }
                }


                if ($uploadFile2 = $request->file($i . 'uploadFile2')) {
                    $countTwo = $data[$i . 'count2'];
                    for ($j = 1; $j <= $countTwo; $j++) {
                        foreach ($uploadFile2 as $key => $value) {

                            if ($key == $data[$i . 'skip' . $j]) {
                                unset($uploadFile2[$key]);
                            }
                        }
                    }


                    foreach ($uploadFile2 as $key => $value) {
                        $name = time() . $key . $value->getClientOriginalName();
                        $value->move('images/' . $user->id . '/', $name);
                        $photo = Photo::create(['photo' => $name, 'user_id' => $user->id]);
                        ShortiePhoto::create(['user_id' => $user->id, 'shortie_id' => $shortie->id, 'photo_id' => $photo->id]);
                    }
                }


                if ($uploadFile3 = $request->file($i . 'uploadFile3')) {
                    $countThree = $data[$i . 'count3'];
                    for ($j = 1; $j <= $countThree; $j++) {
                        foreach ($uploadFile3 as $key => $value) {


                            if ($key == $data[$i . 'skip' . $j]) {
                                unset($uploadFile3[$key]);
                            }
                        }
                    }


                    foreach ($uploadFile3 as $key => $value) {
                        $name = time() . $key . $value->getClientOriginalName();
                        $value->move('images/' . $user->id . '/', $name);
                        $photo = Photo::create(['photo' => $name, 'user_id' => $user->id]);
                        ShortiePhoto::create(['user_id' => $user->id, 'shortie_id' => $shortie->id, 'photo_id' => $photo->id]);
                    }
                }


                if ($uploadFile4 = $request->file($i . 'uploadFile4')) {
                    $countFour = $data[$i . 'count4'];
                    for ($j = 1; $j <= $countFour; $j++) {
                        foreach ($uploadFile4 as $key => $value) {


                            if ($key == $data[$i . 'skip' . $j]) {
                                unset($uploadFile4[$key]);
                            }
                        }
                    }


                    foreach ($uploadFile4 as $key => $value) {
                        $name = time() . $key . $value->getClientOriginalName();
                        $value->move('images/' . $user->id . '/', $name);
                        $photo = Photo::create(['photo' => $name, 'user_id' => $user->id]);
                        ShortiePhoto::create(['user_id' => $user->id, 'shortie_id' => $shortie->id, 'photo_id' => $photo->id]);
                    }
                }
            }
        }




        return redirect("/" . auth()->user()->username);
    }

    public function withoutShortie(Request $request)
    {

        $user = auth()->user();
        $shared = Feed::where(["user_id" => $user->id, "shortie_id" => $request->quoted])->first();
        if ($shared) {
            $shared->delete();
        } else {
            Feed::create(['user_id' => $user->id, 'status' => 'Shortie', 'shortie_id' => $request->quoted]);
        }
        return redirect("/" . auth()->user()->username);
    }

    public function shortie($username, $id, PostUtilService $postUtilService, ShortieService $shortieService)
    {
        $user = $postUtilService->getUser($username);
        $feed = $postUtilService->getFeed($id);
        $recentShorties = $shortieService->recentShorties($user->id);

        return view('shortie.shortie', compact('user', 'feed', 'recentShorties'));
    }

    public function storeShortieComment(Request $request)
    {

        $shortie_id = $request->shortie_id;
        $user = auth()->user();


        $shortie = Shortie::create(['user_id' => auth()->user()->id, 'shortie' => $request->shortie, 'status' => 'comment', 'commenting_on' => $shortie_id]);
        Shortie::where('id', $shortie_id)->increment('replies');

        $replyCount = Shortie::where(["id" => $shortie_id])->first();

        broadcast(new ShortieReplyEvent($shortie_id, $replyCount->replies));

        return $replyCount;
    }

    public function shortieComments($id)
    {
        return Shortie::where(['commenting_on' => $id])->with('user.profile', 'feed', 'shortiePhoto.photo')->get();
    }

    public function getShortieFeed($id)
    {

        $shorties = Shortie::where(["thread_id" => $id])->get();
        $feeds = Feed::all();
        $result = [];

        foreach ($shorties as $s) {
            // if ($f = Feed::where(["shortie_id" => $s->id])->with("shortie.shortiePhoto.photo")->first()) {
            if ($f = Feed::where(['shortie_id' => $s->id])->with('shortie.user.profile', 'post', "thread.feed", 'shortie.shortiePhoto.photo')->first()) {
                array_push($result, $f);
            }
        }

        return $result;
    }
}
