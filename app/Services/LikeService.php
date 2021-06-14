<?php
namespace App\Services;

use App\Category;
use App\Feed;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class LikeService{
    
    public function likePost()
    {

        $feed_id = request()->feed_id;
        $user = auth()->user();
        $status = request()->status;

        $feed = Feed::where(['id' => $feed_id])->first();

        if ($status == 1) {
            $like = Like::create(['feed_id' => $feed_id, 'user_id' => $user->id, 'status' => $status]);
            $feed->increment('likes');
            $like->load('user.profile.photo', 'feed');
            return $like;
        } else {
            $like = Like::where(['feed_id' => $feed_id, 'user_id' => $user->id])->delete();
            $feed->decrement('likes');
            
            $like->load('user.profile.photo');
            return $like;
        }
    }

    public function getLikes($id)
    {
        $feed = Feed::where(["id" => $id])->first();

        if ($feed->post){
        $post_likes = Like::where(['post_id' => $feed->post_id])->get();
        $post_likes->load('user.profile.photo');
        return $post_likes;
        } else if ($feed->shortie) {
            $post_likes = Like::where(['shortie_id' => $feed->shortie_id])->get();
        $post_likes->load('user.profile.photo');
        return $post_likes;
        }
    }  
  
    

}

?>