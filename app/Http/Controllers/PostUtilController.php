<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\CommentReply;
use App\Events\DeletePost;
use App\Events\NewPostEvent;
use App\Feed;
use App\Follow;
use App\Notification;
use App\Like;
use App\Mail\NewPost;
use App\Mail\SendArticleToFriend;
use App\Photo;
use App\Post;
use App\Queue;
use App\Repost;
use App\Services\AccountService;
use App\Services\HistoryService;
use App\Services\PostUtilService;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostUtilController extends Controller
{
    //

    public function getAllFeeds($page, $id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $guest = User::where(["role" => "guest"])->first();
        
        $feeds = $postUtilService->getAllFeeds($user, $page);
        

        if ($page === "profile" ) {
            return $postUtilService->getAllFeeds($user, $page);
        } else if ($page === "welcome") {
            return $postUtilService->getAllFeeds($guest, $page);
        } else if ($page === "home") {
            $home = $postUtilService->getFollowersFeeds();
            return $home;
        }
    }

    public function getAllPosts($page, $id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $guest = User::where(['role' => 'guest'])->first();
        $posts = $postUtilService->getAllPosts($user, $page);
        

        if ($page === "profile" ) {
            return $postUtilService->getAllPosts($user, $page);
        } else if ($page === "welcome") {
            return $postUtilService->getAllPosts($guest, $page);
        } else if ($page === "home") {
            $home = $postUtilService->getFollowersPosts();
            return $home;
        }
    }

    public function getAllShorties($page, $id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $shorties = $postUtilService->getAllShorties($user, $page);
        $guest = User::where(["role" => "guest"])->first();
        

        if ($page === "profile") {
            return $postUtilService->getAllShorties($user, $page);
        } else if ($page === "welcome") {
            return $postUtilService->getAllShorties($guest, $page);
        } else if ($page === "home") {
            $home = $postUtilService->getFollowersShorties();
            return $home;
        }
    }

    public function getHomeFeeds(PostUtilService $postUtilService) {


        $feeds = $postUtilService->getHomeFeeds();

        return $feeds;
    }

    public function getHomePosts(PostUtilService $postUtilService) {

        $posts = $postUtilService->getHomePosts();

        return $posts;
    }

    public function getHomeShorties(PostUtilService $postUtilService) {

        $shorties = $postUtilService->getHomeShorties();

        return $shorties;
    }



    public function response(Request $request)
    {
        //
        
        $user = auth()->user();
        $categories = Category::where(['user_id' => $user->id])->get();
        $photos = Photo::where(['user_id' => $user->id])->orderBy('created_at', 'desc')->get();

        $responding_to = $request->responding_to;

        $feed = Feed::where(['post_id' => $responding_to])->first();

        return view('write.response', compact('categories', 'user', 'feed', 'photos'));
    }

    public function feed($id, PostUtilService $postUtilService){

        return $postUtilService->getFeed($id);
    }

    public function popularPosts($id, PostUtilService $postUtilService) {
        return $postUtilService->popularPosts($id);
    }

    public function mostViewed(PostUtilService $postUtilService) {
        return $postUtilService->mostViewed();
    }

    public function recentPosts($id, PostUtilService $postUtilService) {
        return $postUtilService->recentPosts($id);
    }

    public function getRandomPost(PostUtilService $postUtilService) {
    
        return $postUtilService->getRandomPost();
    
    }
    
    public function getUserRandomPost($id, PostUtilService $postUtilService) {
        
        return $postUtilService->getUserRandomPost($id);
    
    }
    
    public function getUserRandomPostExcept($user_id, $post_id, PostUtilService $postUtilService) {
        return $postUtilService->getUserRandomPostExcept($user_id, $post_id);
    }

    public function publishedReplies($username) {
        $user = User::where(['username' => $username])->first();
        
        $publishedReplies = PostLookUp::where(['user_id' => $user->id, 'status' => 'Response'])->with('user.profile', 'post')->paginate(10);
        $user_id = auth()->user()->id;
    
        $timeline = Follow::where(['user_id' => $user_id])->with('profile.user', 'profile.user.postLookUp')->get();
    
        // return view('posts.published-replies', compact('publishedReplies', 'user', 'timeline'));
    }

    public function post($username, $url, $id, PostUtilService $postUtilService, HistoryService $historyService, AccountService $accountService) {

        Feed::findOrFail($id);
        $user = $postUtilService->getUser($username);
        $post = $postUtilService->getSinglePost($url);
        $feed = $postUtilService->getFeed($id);
        $previous = $postUtilService->getPreviousPost($user, $feed);
        $next = $postUtilService->getNextPost($user, $feed);
        $respondingTo = Post::where(['id' => $feed->post->responding_to])->with('user.profile', 'photo', 'feed')->first();
        $recentPosts = $postUtilService->recentPosts($user->id);
        $accounts = $accountService->accountsToFollow($user->id);

        Feed::where(['id' => $id])->update(['views' => $feed->views + 1]);
        Post::where(['id' => $feed->post_id])->update(['views' => $feed->post->views + 1]);

        
        
        if(auth()->user()){
            $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();    
            if(auth()->user()->hasRead($feed->id) && $feed->status == 'Post Original') {

            } else {
                $historyService->addToHistory($feed);
            
            }
            return view('posts.post', compact('user', 'post', 'feed', 'previous', 'next', 'respondingTo', 'recentPosts', 'accounts', 'n'));
        } else {
            return view('posts.post', compact('user', 'post', 'feed', 'previous', 'next', 'respondingTo', 'recentPosts', 'accounts'));
        }
        
        
        

    }

    public function emailPost(Request $request){


        $feed = Feed::where(["id" => $request->feed_id])->first();
        $post = Post::where(["id" => $request->post_id])->first();

        $recipient = $request->recipient;
        
        $url = $request->url;
        $route = route('post.url', [$post->user->username, $post->url, $feed->id]);
        try {
        Mail::to($recipient)->send(new SendArticleToFriend($post, $route));    
        } catch (Exception $e) {
            if ($e) {
                if (auth()->user()) {
                    $user = auth()->user();
                Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
                $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
                $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        
                return view('errors.sendArticle', compact('user', 'n', 'route', 'post', 'feed'));
                }
                
                return view('errors.sendArticle', compact("route", "post", "feed"));
                
            }
        }
    

            return view("mail.sendArticle", compact("route", "post"));
    }

    public function hashtags (PostUtilService $postUtilService) {
        $top_hashtags = $postUtilService->getTopHashtags();
        

        if (auth()->user()) {
                $user = $postUtilService->getAuthUser();
                $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
                return view("hashtags.index", compact('top_hashtags', 'n', 'user'));
        }
        return view("hashtags.index", compact('top_hashtags'));
    }

    public function getHashtagPosts($hashtag, PostUtilService $postUtilService){

        $hashtagPosts = $postUtilService->getHashtagPosts($hashtag);
        
        
        $top_categories = $postUtilService->getTopCategories();
        $top_authors = $postUtilService->getMostPopularAuthors();
        $random_post = $postUtilService->getRandomPost();
        // $most_read = $postUtilService->mostRead();
        $top_hashtags = $postUtilService->getTopHashtags();
        

if(auth()->user()) {
    $user = $postUtilService->getAuthUser();
    $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
    return view('hashtags.hashtag', compact('hashtagPosts', 'hashtag', 'user', 'top_authors', 'top_categories', 'random_post', 'top_hashtags', 'n'));
} else {
    $user = User::where(['role' => 'guest'])->first();
    return view('hashtags.hashtag', compact('hashtagPosts', 'hashtag', 'user', 'top_authors', 'top_categories', 'random_post', 'top_hashtags'));
}
        
    }

    public function getUserLikes(PostUtilService $postUtilService, Request $request){

    $user = $request->user_id;
    $feed = $request->feed_id;

        return $postUtilService->getUserLikes($user, $feed);
    }


    public function deletePost($id)
    {
        //
        $post = Post::findOrFail($id);

        if (! Gate::allows('delete-post', $post)) {
            abort(403);
        }

        $feed = Feed::findOrFail($id);
        $postId = $feed->post_id;
        $comments = Comment::where("feed_id", $feed->id)->get();
        Notification::where(['feed_id' => $feed->id])->delete();
        foreach($comments as $comment) {
            if ($reply = CommentReply::where("comment_id", $comment->id)->first()) {
                    $reply->delete();
            }
        }
        Comment::where(['feed_id' => $feed->id])->delete();
        // $feed = Feed::where(["id" => $id])->first();
        Like::where(["post_id" => $feed->post_id])->delete();
        Repost::where(["post_id" => $feed->post_id])->delete();
        $post = Post::where(["id" => $feed->post_id])->delete();
        Feed::where(['post_id' => $feed->post_id])->delete();
        // $feed->delete();


        broadcast(new DeletePost($postId));
        // return $feed;
    }

    public function queueAction(Request $request, $id, $user_id) {

        $feed = Feed::where(["id" => $id])->with("post")->first();
        
        $action = $request->get('action');
            switch ($action) {
                case 'Queue':
                    Queue::create(['feed_id' => $id, 'post_id' => $feed->post_id, 'user_id' => $user_id]);

                    break;
                case 'Queued':
                    Queue::where(['feed_id' => $id, 'post_id' => $feed->post_id, 'user_id' => $user_id])->delete();
                    break;
            
                }

        return "";
    }

    public function deleteFromQueue(){

        $user = auth()->user();
        return "hello";
        return Queue::where('feed_id', $user->id)->delete();

            
    }

    public function getTopHashtags (PostUtilService $postUtilService) {
        $top_hashtags = $postUtilService->getTopHashtags();
        return $top_hashtags;
    }

    public function popular(){
        $posts = Post::where("views", ">", 5)->with('feed', 'user')->get();
        
        

        if (auth()->user()) {
            $user = auth()->user();
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

        return view('popular.index', compact('user', 'n', 'posts'));
        }
        
        return view('popular.index', compact( 'posts'));
    }

    public function discover(){
        $posts = Post::where("views", ">", 5)->with('feed', 'user')->get();
        
        

        if (auth()->user()) {
            $user = auth()->user();
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

        return view('discover.index', compact('user', 'n', 'posts'));
        }
        
        return view('discover.index', compact( 'posts'));
    }

    public function topPages(){
        $posts = Post::where("views", ">", 5)->with('feed', 'user')->get();
        
        

        if (auth()->user()) {
            $user = auth()->user();
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

        return view('pages.index', compact('user', 'n', 'posts'));
        }
        
        return view('pages.index', compact( 'posts'));
    }

}
