<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Services\AccountService;
use App\Services\PhotoService;
use App\Services\PostUtilService;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PostUtilService $postUtilService, PhotoService $photoService, AccountService $accountService)
    {

        $username = auth()->user()->username;
        $user = $postUtilService->getUser($username);
        $users = User::where('id', '!=', $user->id)->with('profile')->first();
        $photos = $photoService->getPhotos($user);
        $feeds = $postUtilService->getFollowersFeeds();
        $photos = Photo::where(['user_id' => $user->id])->orderBy('created_at', 'desc')->limit(9)->get();
        $recentPosts = $postUtilService->recentPosts($user->id);
        $accounts = $accountService->accountsToFollow($user->id);
        $top_categories = $postUtilService->getTopCategories();
        $top_hashtags = $postUtilService->getTopHashtags();

        return view('home', compact('feeds', 'user', 'photos', 'recentPosts', 'accounts', 'top_categories', 'top_hashtags'));
    }

    public function imagesUploadPost(Request $request)
    {

            
                $vote = Vote::create(["user_id" => 1, "poll_id" => 1, "my_choice" => 1]);
            
    
          

    }


}
