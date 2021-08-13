<?php

namespace App\Http\Controllers;

use App\Events\NewPostEvent;
use App\Events\ShareFeed;
use App\Feed;
use App\Notification;
use App\Post;
use App\Repost;
use App\Services\RepostService;
use App\Shortie;
use Illuminate\Http\Request;

class RepostController extends Controller
{
    //

    public function repost($id)
    {

        $feed = Feed::findOrFail($id);
        $user = auth()->user();

        return view("write.repost", compact("feed", "user"));
    }

    public function hey(Request $request, $id, $user_id) {
        return $request->action;
    }

    public function share(Request $request, $id, $user_id)
    {

        $feed = Feed::where(["id" => $id])->with("post", "shortie")->first();

        if ( $feed->post) {
        $action = $request->get('action');
        switch ($action) {
            case 'Share':
                Post::where('id', $feed->post_id)->increment('shares');
                // $feed = Feed::where('id', $id)->first();
                $post = Post::where('id', $feed->post_id)->first();
                Feed::create(['user_id' => $user_id, 'post_id' => $post->id, 'status' => 'post', 'reposted' => 'yes']);
                $data = Repost::create(["user_id" => $user_id, "post_id" => $feed->post_id, "status" => 1]);
                $data->load('user.profile.photo', 'feed');

                
                Notification::create(["user_id" => $feed->post->user_id, "type" => "share", "notifier" => $data->user_id, "message" => "shared your post", "read" => "no", "feed_id" => $feed->id]);
                $myNotifications = Notification::where(["user_id" => $feed->post->user_id, "read" => "no"])->get();

                $count = $myNotifications->count();
                broadcast(new NewPostEvent($count, $feed->post->user_id))->toOthers();

                break;
            case 'Shared':
                Post::where('id', $feed->post_id)->decrement('shares');
                $record = Repost::where(["user_id" => $user_id, "post_id" => $feed->post_id])->delete();
                // $feed = Feed::where(["id" => $id])->first();
                $f = Feed::where(["post_id" => $feed->post_id, "user_id" => $user_id])->delete();
                // $f->delete();
                // $record->delete();

                break;
        }
        $shareCount = Post::where(["id" => $feed->post_id])->first();
        broadcast(new ShareFeed($id, $action, $user_id, $shareCount->shares));
        return '';

    } else if ($feed->shortie) {

        $action = $request->get('action');
        switch ($action) {
            case 'Share':
                Shortie::where('id', $feed->shortie_id)->increment('shares');
                // $feed = Feed::where('id', $id)->first();
                $shortie = Shortie::where('id', $feed->shortie_id)->first();
                Feed::create(['user_id' => $user_id, 'shortie_id' => $shortie->id, 'status' => 'Reposted', 'reposted' => 'yes']);
                $data = Repost::create(["user_id" => $user_id, "feed_id" => $id, "shortie_id" => $feed->shortie_id, "status" => 1]);

                Notification::create(["user_id" => $feed->shortie->user_id, "type" => "share", "notifier" => $data->user_id, "message" => "shared your shortie", "read" => "no", "feed_id" => $feed->id]);
                    $myNotifications = Notification::where(["user_id" => $feed->shortie->user_id, "read" => "no"])->get();
    
                    $count = $myNotifications->count();
                    broadcast(new NewPostEvent($count, $feed->shortie->user_id))->toOthers();

                break;
            case 'Shared':
                Shortie::where('id', $feed->shortie_id)->decrement('shares');
                $record = Repost::where(["user_id" => $user_id, "feed_id" => $id, "shortie_id" => $feed->shortie_id])->delete();
                // $feed = Feed::where(["id" => $feed_id])->first();
                $deleteFeed = Feed::where(["shortie_id" => $feed->shortie_id, "user_id" => $user_id])->delete();
                // $deleteFeed->delete();
                // $record->delete();

                break;
        }

        $shareCount = Shortie::where(["id" => $feed->shortie_id])->first();
        broadcast(new ShareFeed($id, $action, $user_id, $shareCount->shares));
        return '';
    }
    }


    public function getShares($id)
    {
        $feed = Feed::where(["id" => $id])->with("post", "shortie")->first();

        if ($feed->post){
        $post_likes = Repost::where(['post_id' => $feed->post_id])->get();
        $post_likes->load('user.profile');
        return $post_likes;
        } else if ($feed->shortie) {
            $post_likes = Repost::where(['shortie_id' => $feed->shortie_id])->get();
        $post_likes->load('user.profile');
        return $post_likes;
        }

    }

    public function handleRepost(RepostService $repostService, Request $request)
    {


        $repostService->handleRepost();
        Feed::where('id', $request->feed_id)->increment('quotes');
        $route = $request->route;
        return redirect($route);
    }


    public function getPostReposts($id, RepostService $repostService)
    {
        return $repostService->getPostReposts($id);
    }

    public function repostDelete(RepostService $repostService)
    {

        return $repostService->repostDelete();
    }
}
