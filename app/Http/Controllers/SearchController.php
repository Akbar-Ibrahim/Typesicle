<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Notification;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\PostLookUp;
use App\Services\SearchService;

class SearchController extends Controller
{
    //

    public function searchAuthorList(SearchService $searchService)
    {
        return $searchService->searchAuthorList();
    }


    public function searchAuthor(SearchService $searchService)
    {
        $searchterm = request()->q;
        $users = User::where('name','LIKE','%'.$searchterm.'%')->orWhere('username','LIKE','%'.$searchterm.'%')
        ->with('profile')->get();

        $page_name = "Search Users";

        $user = auth()->user();
        $guest = ["id" => 0, "name" => "guest", "username" => "@guest"];

        
        if(auth()->user()) {
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        return view('searchauthor', compact('users', 'searchterm', 'page_name', 'user', 'guest', 'n'));
        } else {
            return view('searchauthor', compact('users', 'searchterm', 'page_name', 'user', 'guest'));
        }

    }

    public function searchPostList(SearchService $searchService)
    {
        return $searchService->searchPostList();
    }

    public function searchPost(SearchService $searchService)
    {

        $searchterm = request()->q;
        $posts = Post::where('title', 'LIKE', '%' . $searchterm . '%')->with('user.profile', 'feed')->get();
        $feeds = [];

        if (auth()->user()) {
        foreach ($posts as $post) {
            if ($post !== null) {
            $feed = Feed::where(["post_id" => $post->id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
            if ($feed !== null) {
                if ($feed->post) {
                    if (auth()->user()->isLiked($feed->post_id)) {
                        // $feed->is_liked = "yes";
                        $feed->post->is_liked = 1;
                    } else {
                        // $feed->is_liked = "no";
                        $feed->post->is_liked = 0;
                    }
    
                    if (auth()->user()->isReposted($feed->post_id)) {
                        // $feed->is_shared = "yes";
                        $feed->post->is_shared = 1;
                    } else {
                        // $feed->is_shared = "no";
                        $feed->post->is_shared = 0;
                    }
    
                    if (auth()->user()->isQueued($feed->post_id)) {
                        $feed->post->is_queued = 1;
                    } else {
                        $feed->post->is_queued = 0;
                    }
    
    
                    array_push($feeds, $feed);
    
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
    
                    array_push($feeds, $feed);
                }
            }
            }
        }
        }

        $searchResult = [];

        foreach ($posts as $post) {
            if ($post !== null) {
            $feed = Feed::where(["post_id" => $post->id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
            if ($feed !== null) {
                array_push($searchResult, $feed);
            }
        
            }
        }
        
        $page_name = "Search Posts";
        $user = auth()->user();
        $guest = ["id" => 0, "name" => "guest", "username" => "@guest"];

        if(auth()->user()) {
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        return view('searchpost', compact('posts', 'searchterm', 'page_name', 'user', 'feeds', 'searchResult', 'guest', 'n'));
        } else {
            return view('searchpost', compact('posts', 'searchterm', 'page_name', 'user', 'feeds', 'searchResult', 'guest'));
        }
    }
}
