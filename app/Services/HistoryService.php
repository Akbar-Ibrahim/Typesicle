<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Profile;
use App\Category;
use Illuminate\Auth\AuthManager;
use App\Follow;
use Carbon\Carbon;
use App\View;
use App\Like;
use App\Hashtag;
use App\PostLookUp;
use App\History;

class HistoryService
{

    public function getAuthUser(){

        $users = User::all();
        $user = auth()->user();   
    
        return User::where('id', $user->id)->first();
    
    }
    

    public function getUser($username) {

        return User::where('username', $username)->first();
    }


    public function addToHistory($feed) {

        return History::create(["user_id" => auth()->user()->id, 'feed_id' => $feed->id]);

    }

    public function getHistory($user){
        
        $date = \Carbon\Carbon::today()->subDays(30);
    
             
        // return History::where('user_id', $user->id)->where('created_at', '>=', $date)->with('feed', 'post')->get();
        $history = History::where(['user_id' => $user->id])->with('feed.user', 'feed.shortie', 'feed.post')->orderBy('created_at', 'desc')->get();
        

        $histories = [];

            foreach ($history as $h) {
                if ($h->feed)
                if ($h->feed->post) {
                if (auth()->user()->isLiked($h->feed->post_id)) {
                    $h->feed->post->is_liked = 1;
                } else {
                    $h->feed->post->is_liked = 0;
                }

                if (auth()->user()->isReposted($h->feed->post_id)) {
                    $h->feed->post->is_shared = 1;
                } else {
                    $h->feed->post->is_shared = 0;
                }
                array_push($histories, $h);
            } 
            }


        return $histories;




        
    }


}
