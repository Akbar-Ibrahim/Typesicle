<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Profile;
use App\Category;
use App\Feed;
use App\Follow;
use Carbon\Carbon;
use App\View;
use App\Like;
use App\Hashtag;
use App\HashtagPost;
use App\PostHashtag;
use App\RecentlyRead;
use Illuminate\Support\Facades\Auth;

class PostUtilService
{

    public function getAuthUser()
    {

        $users = User::all();
        $user = auth()->user();

        return User::where('id', $user->id)->first();
    }

    public function feeds()
    {

        $user = auth()->user();
        $users = User::all();

        foreach ($users as $feed) {
            if ($user->isFollowing($feed->profile->id)  || $feed->isFollowing($user->profile->id)) {
                // echo $feed;
            }
        }
    }

    public function getUser($username)
    {

        return User::where('username', $username)->with('profile.photo')->firstOrFail();
        
    }


    public function getPostsByFollowers()
    {

        $users = User::all();
        $user = auth()->user();
        $user_id = auth()->user()->id;


        return Follow::where("profile_id", $user->profile->id)->with('user.posts')->get();
    }

    public function getPostsByFollowing()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;

        return Follow::where("user_id", $user->id)->with('profile.user.feed')->get();
    }

    public function getRandomPost()
    {

        // return Feed::where(['status' => 'Original'])->with('post.user', 'user.profile')->inRandomOrder()->first();
        return Post::with('user', 'feed')->inRandomOrder()->first();
    }

    public function getUserRandomPost($id)
    {

        return Feed::where(['user_id' => $id, 'status' => 'Post Original'])->with('post.user')->inRandomOrder()->first();
    }

    public function getUserRandomPostExcept($user_id, $post_id)
    {

        return Feed::where('id', '!=', $post_id)->where('user_id', $user_id)->where('status', 'Post Original')->with('post.user', 'user.profile')->inRandomOrder()->first();
    }

    // public function getAllPosts(){

    //     return Post::paginate(1);


    // }

    public function getAllCategories()
    {
        return Category::with('user.profile', 'posts')->orderBy('name', 'ASC')->get();
    }

    public function getUserCategories($user)
    {

        return Category::where(['user_id' => $user->id])->with('user.profile', 'posts')->get();
    }

    public function getTopCategories()
    {

        return Category::postCountTen()->with('posts')->get();
    }

    // public function mostRead(){

    //     return View::orderBy('views', 'desc')->with('feed')->limit(5)->get();

    // }

    public function getPreviousPost($user, $feed)
    {

        return Post::where('user_id', $user->id)->where('id', '<', $feed->post->id)->orderBy('id', 'desc')->first();
    }


    public function getNextPost($user, $feed)
    {

        return Post::where('user_id', $user->id)->where('id', '>', $feed->post->id)->orderBy('id')->first();
    }

    // public function getSinglePost($url, $id) {
    //     return Post::where(['url' => $url, 'id' => $id])->first();    
    // }

    public function getSinglePost($url)
    {

        return Post::where(['url' => $url])->first();
    }

    public function getLikes()
    {
        return Like::all();
    }


    public function getRecentPosts($user)
    {

        return Feed::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function getOtherAuthorsPosts($feed)
    {

        return Feed::where('user_id', '!=', $feed->post->user_id)->where('post_id', '!=', $feed->post->id)->get();
    }

    // public function updatePostView($feed) {

    //     return View::where(['feed_id' => $feed->id])->update(['views' => $post_look_up->view->views + 1]);
    // }

    public function getPostsFromSimilarCategory($feed)
    {



        return Feed::where('post_id', '!=', $feed->post->id)->get();
    }


    public function getMostPopularAuthors()
    {

        return User::postGreaterTen()->where('id', '!=', auth()->user()->id)->with('posts')->get();
    }

    public function getTopHashTags()
    {
        $result = Hashtag::getTopHashtags()->with('feed')->get();
        $hashtags = [];

        foreach ($result as $r) {
            str_replace('#', '', $r->hashtag);
            array_push($hashtags, $r);
        }

        return $hashtags;
    }


    public function getEveryPost()
    {
        return Feed::all();
    }

    public function getPost($url, $id)
    {

        return Post::where(['url' => $url, 'id' => $id])->with('feeds')->first();
    }

    public function getFeed($id)
    {

        $forGuest = Feed::where('id', $id)->with('user.profile', 'comments', 'reposts', 'post.user.profile', 'feedLikes', 'post.photo', 'thread.shorties', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz', 'poll.votes')->orderBy('created_at', 'desc')->firstOrFail();
        $feed = Feed::where('id', $id)->with('user.profile', 'comments', 'reposts', 'post.user.profile', 'feedLikes', 'post.photo', 'thread.shorties', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz', 'poll.votes')->orderBy('created_at', 'desc')->firstOrFail();

        $data = [];

        if (Auth::check()) {
            if ($feed !== null) {
            if ($feed->post) {
                if (Auth::user()->isLiked($feed->post_id)) {
                    $feed->post->is_liked = 1;
                } else {
                    $feed->post->is_liked = 0;
                }

                if (Auth::user()->isReposted($feed->post_id)) {
                    $feed->post->is_shared = 1;
                } else {
                    $feed->post->is_shared = 0;
                }

                if (Auth::user()->isQueued($feed->post_id)) {
                    $feed->post->is_queued = 1;
                } else {
                    $feed->post->is_queued = 0;
                }
            }
            array_push($data, $feed);
        }
            return $feed;
        } else {
            return $forGuest;
        }
    }

    public function getAllFeeds($user, $page)
    {
        // return Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz')->orderBy('created_at', 'desc')->with('user.profile')->paginate(15);
        // return Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'feedLikes', 'post.photo', 'thread.shorties', 'shortie.user', 'shortie.thread.feed', 'shortie.shortiePhoto.photo', 'quiz')->orderBy('created_at', 'desc')->get();

        $forGuest = [];
        $feeds = [];
        if ($page === "profile") {
        $forGuest = Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
        $feeds = Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
        } else if ($page === "welcome") {
            return Feed::with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();            
        }
        $result = [];

        if (Auth::check()) {
            foreach ($feeds as $feed) {
                if ($feed !== null) {
                    if ($feed->post) {
             
                        if (Auth::user()->isLiked($feed->post_id)) {
                            $feed->post->is_liked = 1;
                        } else {
                            $feed->post->is_liked = 0;
                        }
        
                        if (Auth::user()->isReposted($feed->post_id)) {
                            $feed->post->is_shared = 1;
                        } else {
                            $feed->post->is_shared = 0;
                        }
        
                        if (Auth::user()->isQueued($feed->post_id)) {
                            $feed->post->is_queued = 1;
                        } else {
                            $feed->post->is_queued = 0;
                        }
        
        
        
                        array_push($result, $feed);
                    
                }

                if ($feed->status === 'Shortie' || $feed->thread) {
                    if ($feed->shortie !== null) {
                    if (Auth::user()->isLikedShortie($feed->shortie_id)) {
                        $feed->shortie->is_liked = 1;
                    } else {
                        $feed->shortie->is_liked = 0;
                    }

                    if (Auth::user()->isSharedShortie($feed->shortie_id)) {
                        $feed->shortie->is_shared = 1;
                    } else {
                        $feed->shortie->is_shared = 0;
                    }

                    array_push($result, $feed);
                }
            }
            }
            }

            return $result;
        } else {
            // if ($page === "profile") {
            //     return Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
            // } else if ($page === "welcome") {
            //     return Feed::with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
            // }
            return $forGuest;
        }
    }

    public function getAllPosts($user, $page)
    {
        $forGuest = [];
        $feeds = [];

        if ($page === "profile") {
        $forGuest = Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie')->orderBy('created_at', 'desc')->get();
        $feeds = Feed::where('user_id', $user->id)->with('user.profile', 'post.user', 'post.photo', 'shortie')->orderBy('created_at', 'desc')->get();
        } else if ($page === "welcome") {
            return Feed::with('user.profile', 'post.user', 'post.photo', 'shortie')->orderBy('created_at', 'desc')->get();
        }
        $posts = [];

        if (Auth::check()) {
        foreach ($feeds as $feed) {
            if ($feed !== null) {
            if ($feed->post) {
             
                if (Auth::user()->isLiked($feed->post_id)) {
                    $feed->post->is_liked = 1;
                } else {
                    $feed->post->is_liked = 0;
                }

                if (Auth::user()->isReposted($feed->post_id)) {
                    $feed->post->is_shared = 1;
                } else {
                    $feed->post->is_shared = 0;
                }

                if (Auth::user()->isQueued($feed->post_id)) {
                    $feed->post->is_queued = 1;
                } else {
                    $feed->post->is_queued = 0;
                }



                array_push($posts, $feed);
            }
            }
        }

        return $posts;
    } else {
        return $forGuest;
    }
    }


    public function getAllShorties($user, $page)
    {
        $forGuest = [];
        $feeds = [];

        if ($page === "profile") {
        $forGuest = Feed::where('user_id', $user->id)->with('user.profile', 'post', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
        $feeds = Feed::where('user_id', $user->id)->with('user.profile', 'post', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
    } else if ($page === "welcome") {
        return Feed::with('user.profile', 'post', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
    }
        $shorties = [];

        if (Auth::check()) {
            foreach ($feeds as $feed) {

                        if ($feed->status === 'Shortie' || $feed->thread) {
                            if ($feed->shortie !== null) {
                            if (Auth::user()->isLikedShortie($feed->shortie_id)) {
                                $feed->shortie->is_liked = 1;
                            } else {
                                $feed->shortie->is_liked = 0;
                            }

                            if (Auth::user()->isSharedShortie($feed->shortie_id)) {
                                $feed->shortie->is_shared = 1;
                            } else {
                                $feed->shortie->is_shared = 0;
                            }

                            array_push($shorties, $feed);
                        }
                    }

            }
            return $shorties;
        } else {
            return $forGuest;
        }
    }

    public function getHomeFeeds() {
        $feeds = Feed::with('user.profile', 'thread', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->paginate(100);
        return response()->json($feeds);
    }

    public function getHomePosts () {
        $posts = Feed::with('user.profile', 'post.user', 'post.photo', 'shortie')->orderBy('created_at', 'desc')->paginate(100);
        return response()->json($posts);
    }

    public function getHomeShorties() {

        $shorties = Feed::with('user.profile', 'post', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->paginate(100);
        return response()->json($shorties);
    }


    public function getFollowersFeeds()
    {

        $user = auth()->user();
        // $resultSet = Feed::orderBy('created_at', 'desc')->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz')->orderBy('created_at', 'desc')->with('user.profile')->paginate(15);
        $resultSet = Feed::orderBy('created_at', 'desc')->with('user.profile', 'post.user', 'feedLikes', 'post.photo', 'thread.shorties', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz', 'poll.votes')->get();
        $feeds = [];

        foreach ($resultSet as $result) {
            if ($user->isFollowing($result->user->profile->id) ) {
                array_push($feeds, $result);
            }
        }


        $result = [];

        if (Auth::check()) {
            foreach ($feeds as $feed) {
                if ($feed !== null) {
                    if ($feed->post) {
             
                        if (Auth::user()->isLiked($feed->post_id)) {
                            $feed->post->is_liked = 1;
                        } else {
                            $feed->post->is_liked = 0;
                        }
        
                        if (Auth::user()->isReposted($feed->post_id)) {
                            $feed->post->is_shared = 1;
                        } else {
                            $feed->post->is_shared = 0;
                        }
        
                        if (Auth::user()->isQueued($feed->post_id)) {
                            $feed->post->is_queued = 1;
                        } else {
                            $feed->post->is_queued = 0;
                        }
        
        
        
                        array_push($result, $feed);
                    
                }

                if ($feed->status === 'Shortie' || $feed->thread) {
                    if ($feed->shortie !== null) {
                    if (Auth::user()->isLikedShortie($feed->shortie_id)) {
                        $feed->shortie->is_liked = 1;
                    } else {
                        $feed->shortie->is_liked = 0;
                    }

                    if (Auth::user()->isSharedShortie($feed->shortie_id)) {
                        $feed->shortie->is_shared = 1;
                    } else {
                        $feed->shortie->is_shared = 0;
                    }

                    array_push($result, $feed);
                }
            }
            }
            }


        } 

        return $result;
    }

    public function getFollowersPosts(){

        $user = auth()->user();
        $resultSet = Feed::with('user.profile', 'post.user', 'post.photo', 'shortie')->orderBy('created_at', 'desc')->get();
        $feeds = [];

        foreach ($resultSet as $result) {
            if ($user->isFollowing($result->user->profile->id))
                array_push($feeds, $result);
        }

        $posts = [];

        if (Auth::check()) {
            foreach ($feeds as $feed) {
                if ($feed !== null) {
                if ($feed->post) {
                 
                    if (Auth::user()->isLiked($feed->post_id)) {
                        $feed->post->is_liked = 1;
                    } else {
                        $feed->post->is_liked = 0;
                    }
    
                    if (Auth::user()->isReposted($feed->post_id)) {
                        $feed->post->is_shared = 1;
                    } else {
                        $feed->post->is_shared = 0;
                    }
    
                    if (Auth::user()->isQueued($feed->post_id)) {
                        $feed->post->is_queued = 1;
                    } else {
                        $feed->post->is_queued = 0;
                    }
    
    
    
                    array_push($posts, $feed);
                }
                }
            }
    
            
        }
        return $posts;
    }

    public function getFollowersShorties()
    {

        $user = auth()->user();
        // $resultSet = Feed::where(['status' => 'shortie'])->orderBy('created_at', 'desc')->with('user.profile', 'post.user', 'post.photo', 'shortie.user', 'shortie.shortiePhoto.photo', 'quiz')->orderBy('created_at', 'desc')->with('user.profile')->get();
        $resultSet= Feed::with('user.profile', 'post', 'shortie.user', 'shortie.shortiePhoto.photo')->orderBy('created_at', 'desc')->get();
        $feeds = [];

        foreach ($resultSet as $result) {
            if ($user->isFollowing($result->user->profile->id))
                array_push($feeds, $result);
        }

        $result = [];

        if (Auth::check()) {
            foreach ($feeds as $feed) {

                        if ($feed->status === 'Shortie' || $feed->thread) {
                            if ($feed->shortie !== null) {
                            if (Auth::user()->isLikedShortie($feed->shortie_id)) {
                                $feed->shortie->is_liked = 1;
                            } else {
                                $feed->shortie->is_liked = 0;
                            }

                            if (Auth::user()->isSharedShortie($feed->shortie_id)) {
                                $feed->shortie->is_shared = 1;
                            } else {
                                $feed->shortie->is_shared = 0;
                            }

                            array_push($result, $feed);
                        }
                    }

            }
            
        }
        
        return $result;
    }

    public function getHashtagPosts($hashtag)
    {

        return Hashtag::where('hashtag', '#' . $hashtag)->with('feed.post.photo', 'feed.post.user.profile')->get();
    }

    public function hashtags()
    {
        return Hashtag::all();
    }

    public function getPostHashtags($feed)
    {
        return PostHashtag::where(['feed_id' => $feed->id])->get();
    }

    public function popularPosts($id)
    {
        // return Feed::where('user_id', $id)->where('views', '>', 10)->where(['status' => 'Post Original'])->with('user.profile.photo', 'post.user')->orderBy('created_at', 'desc')->get();
        return Post::where('user_id', $id)->where('views', '>', 10)->with('user.profile.photo', 'feed', 'category')->orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function mostViewed(){
        // return Feed::where("views", ">", 4)->where("status", "Post Original")->with("post.user")->get();
        return Post::where("views", ">", 4)->with("feed", "user", "category")->get();
    }

    public function recentPosts($id)
    {
        // return Feed::where(['user_id' => $id, 'status' => 'Original'])->with('user.profile.photo', 'post.user')->orderBy('created_at', 'desc')->limit(5)->get();
        // return Post::where(['user_id' => $id])->with('user.profile.photo', 'feed')->orderBy('created_at', 'desc')->limit(5)->get();
        $posts = Post::where(['user_id' => $id])->limit(5)->get();

        $feeds = [];

        foreach ($posts as $post) {
            if ($post !== null) {
                $feed = Feed::where(["post_id" => $post->id])->with("post.photo", "post.user.profile", "post.category", "user.profile", "shortie.shortiePhoto.photo")->first();
                if ($feed !== null) {
                    array_push($feeds, $feed);
                }
            }
        }

        return $feeds;
    }

    public function topAuthors()
    {
        $users = User::all();
    }


    public function getUserLikes($user, $feed)
    {

        // $user_id = $user;
        // $feed_id = $feed;
        // $myuser = User::where(["id" => $user_id])->first();
        // $myfeed = Feed::where(["id" => $feed_id])->first();

        // $userLikes = Like::where(["user_id" => $user_id])->first();
        // $allFeeds = Feed::all();
        // $likes = [];

        //         foreach($allFeeds as $f) {
        //         if ($myuser->isLiked($f->id)) {
        //             $f->liked = "liked";
        //             array_push($likes, $f);
        //         } else {
        //             $f->liked = "not liked";
        //             array_push($likes, $f);

        //         }
        //     }
        return "Hey";
    }
}
