<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Services\PostUtilService;
use App\Shortie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Notification;
use App\Photo;
use App\Profile;
use App\Services\AccountService;
use App\Services\PhotoService;




class WelcomeController extends Controller
{
    //
    
        public function welcome (PostUtilService $postUtilService) {
            $feeds = $postUtilService->getHomeFeeds();
            $user = ["id" => 0, "name" => "guest"];
            $users = User::all();
            $articles = Post::all();
            $categories = Category::all();
            $shorties = Shortie::all();
            $articleCount = $articles->count();
            $shortieCount = $shorties->count();
            $posts = $shortieCount + $articleCount;
            
            return view('welcome', compact('feeds', 'user', 'users', 'posts', 'categories'));
        }


        public function index(PostUtilService $postUtilService, PhotoService $photoService, AccountService $accountService)
    {


        // $feeds = $postUtilService->getHomeFeeds();
        $feeds = [];


        if (auth()->user()){
        $user = auth()->user();
        $feeds = $postUtilService->getAllFeeds($user, "welcome");
        $addToGroup = [];
        if (auth()->user()) {
            foreach ($feeds as $feed) {
                if ($feed->post) {
                if (auth()->user()->isLiked($feed->post_id)) {
                    $feed->post->is_liked = 1;
                } else {
                    $feed->post->is_liked = 0;
                }

                if (auth()->user()->isReposted($feed->post_id)) {
                    $feed->post->is_shared = 1;
                } else {
                    $feed->post->is_shared = 0;
                }

                if (auth()->user()->isQueued($feed->post_id)) {
                    $feed->post->is_queued = 1;
                } else {
                    $feed->post->is_queued = 0;
                }


                array_push($addToGroup, $feed);
            } else if ($feed->shortie) {
                if (auth()->user()->isLikedShortie($feed->shortie_id)) {
                    $feed->shortie->is_liked = 1;
                } else {
                    $feed->shortie->is_liked = 0;
                }

                if (auth()->user()->isSharedShortie($feed->shortie_id)) {
                    $feed->shortie->is_shared = 1;
                } else {
                    $feed->shortie->is_shared = 0;
                }

                array_push($addToGroup, $feed);
            }
            }
        }
    
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
            return view('welcome.index', compact('feeds', 'user', 'addToGroup', 'n'));
        } else {
            
            $page = "welcome";
            $guestUser = User::where(["role" => "guest"])->first();
            $name = $guestUser->username;
            $user = $postUtilService->getUser($name);
            $feeds = $postUtilService->getAllFeeds($user, $page);
            return view('welcome.index', compact('feeds', 'user'));
        }

        
    }
        
}
