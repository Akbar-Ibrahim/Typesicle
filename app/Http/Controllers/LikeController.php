<?php

namespace App\Http\Controllers;

use App\Events\LikeFeed;
use App\Feed;
use App\Like;
use App\Post;
use App\Services\LikeService;
use App\Services\PostUtilService;
use App\Shortie;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function likeAction(Request $request, $id, $user_id)
    {

        $feed = Feed::where(["id" => $id])->with("post", "shortie")->first();

        

        if ($feed->post) {
            $action = $request->get('action');
            switch ($action) {
                case 'Like':
                    // Feed::where('id', $id)->increment('likes');
                    Post::where('id', $feed->post_id)->increment('likes');
                    $data = Like::create(["user_id" => $user_id, "post_id" => $feed->post_id]);
                    $data->load('user.profile.photo', 'feed');

                    break;
                case 'Unlike':
                    // Feed::where('id', $id)->decrement('likes');
                    Post::where('id', $feed->post_id)->decrement('likes');
                    $record = Like::where(["user_id" => $user_id, "post_id" => $feed->post_id])->first();
                    $record->delete();

                    break;
            }
            $likeCount = Post::where(["id" => $feed->post_id])->first();
            broadcast(new LikeFeed($id, $action, $user_id, $likeCount->likes));
            return '';
        } else if ($feed->shortie) {
            $action = $request->get('action');
            switch ($action) {
                case 'Like':
                    // Feed::where('id', $id)->increment('likes');
                    Shortie::where('id', $feed->shortie_id)->increment('likes');
                    $data = Like::create(["user_id" => $user_id, "shortie_id" => $feed->shortie_id]);
                    $data->load('user.profile.photo', 'feed');

                    break;
                case 'Unlike':
                    // Feed::where('id', $id)->decrement('likes');
                    Shortie::where('id', $feed->shortie_id)->decrement('likes');
                    $record = Like::where(["user_id" => $user_id, "shortie_id" => $feed->shortie_id])->first();
                    $record->delete();

                    break;
            }
            $likeCount = Shortie::where(["id" => $feed->shortie_id])->first();
            broadcast(new LikeFeed($id, $action, $user_id, $likeCount->likes));
            return '';
        }
    }

    public function likePost(LikeService $likeService)
    {

        return $likeService->likePost();
    }


    public function like(Request $request)
    {

        $feed_id = $request->feed_id;
        $user = auth()->user();
        $user_id = $request->user_id;

        $like = Like::where(["user_id" => $user_id, "feed_id" => $feed_id])->first();

        if ($like) {
            $feed = Feed::where('id', $feed_id)->decrement('likes');
            $data = $like->delete();

            return "";
        } else {
            $feed = Feed::where('id', $feed_id)->increment('likes');
            $data = Like::create(["user_id" => $user_id, "feed_id" => $feed_id]);
            $data->load('user.profile.photo', 'feed');
            return $data;
        }
    }

    public function likedPosts($username, PostUtilService $postUtilService)
    {

        $users = User::all();
        $user = $postUtilService->getUser($username);
        $likes = Like::where('user_id', auth()->user()->id)->get();

        return view('likes.index', compact('users', 'user', 'likes'));
    }

    public function getLikes($id, LikeService $likeService)
    {
        return $likeService->getLikes($id);
    }
}
