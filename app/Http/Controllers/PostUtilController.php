<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feed;
use App\Follow;
use App\Notifications\Like;
use App\Photo;
use App\Post;
use App\Queue;
use App\Repost;
use App\Services\AccountService;
use App\Services\HistoryService;
use App\Services\PostUtilService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PostUtilController extends Controller
{
    //

    public function getAllFeeds($id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $feeds = $postUtilService->getAllFeeds($user);

        return $feeds;
    }

    public function getAllPosts($id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $posts = $postUtilService->getAllPosts($user);

        return $posts;
    }

    public function getAllShorties($id, PostUtilService $postUtilService) {

        $user = User::where("id", $id)->first();
        $shorties = $postUtilService->getAllShorties($user);

        return $shorties;
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

        $user = $postUtilService->getUser($username);
        $post = $postUtilService->getSinglePost($url);
        $feed = $postUtilService->getFeed($id);
        $previous = $postUtilService->getPreviousPost($user, $feed);
        $next = $postUtilService->getNextPost($user, $feed);
        $respondingTo = Post::where(['id' => $feed->post->responding_to])->with('user.profile', 'photo', 'feed')->first();
        $recentPosts = $postUtilService->recentPosts($user->id);
        $accounts = $accountService->accountsToFollow($user->id);

        if(auth()->user()){
            if(auth()->user()->hasRead($feed->id) && $feed->status == 'Post Original') {

            } else {
                $historyService->addToHistory($feed);
            
            }
        }
        
        Feed::where(['id' => $id])->update(['views' => $feed->views + 1]);
        Post::where(['id' => $feed->post_id])->update(['views' => $feed->post->views + 1]);

        return view('posts.post', compact('user', 'post', 'feed', 'previous', 'next', 'respondingTo', 'recentPosts', 'accounts'));

    }

    public function emailPost(Request $request){


        $feed = $request->feed;
        $recipient = $request->recipient;
        $title = $request->title;
        $body = $request->body;
        $author = $request->author;
        $id = $request->id;
        $url = $request->url;
        $route = route('post.url', [$author, $url, $id]);
        
    
    
    
             $data = [
                     'greet' => 'you,',
                     'author' => $author,
                     'content' => $body,
                    'title' => $title,
                    'route' => $route,
    
    
                ];
    
                Mail::send('mail.test', $data, function($message) use ($recipient){
                   $message->to($recipient, 'Bro')->subject("Hey, check this post out!");
               });
    

            return redirect()->back();
    }

    public function getHashtagPosts($hashtag, PostUtilService $postUtilService){

        $hashtagPosts = $postUtilService->getHashtagPosts($hashtag);
        
        $user = $postUtilService->getAuthUser();
        $top_categories = $postUtilService->getTopCategories();
        $top_authors = $postUtilService->getMostPopularAuthors();
        $random_post = $postUtilService->getRandomPost();
        // $most_read = $postUtilService->mostRead();
        $top_hashtags = $postUtilService->getTopHashtags();
            
        return view('hashtags.index', compact('hashtagPosts', 'hashtag', 'user', 'top_authors', 'top_categories', 'random_post', 'top_hashtags'));
    }

    public function getUserLikes(PostUtilService $postUtilService, Request $request){

    $user = $request->user_id;
    $feed = $request->feed_id;

        return $postUtilService->getUserLikes($user, $feed);
    }


    public function deletePost($id)
    {
        //

        $feed = Feed::findOrFail($id);
        Feed::where(["post_id" => $feed->post_id])->delete();
        Like::where(["post_id" => $feed->post_id])->delete();
        Repost::where(["post_id" => $feed->post_id])->delete();
        $post = Post::where(["id" => $feed->post_id])->delete();
        $feed->delete();
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

    public function getTopHashtags (PostUtilService $postUtilService) {
        $top_hashtags = $postUtilService->getTopHashtags();
        return $top_hashtags;
    }


}
