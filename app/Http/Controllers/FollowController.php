<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Notification;
use Illuminate\Http\Request;
use App\Services\FollowService;
use App\Services\PostUtilService;

class FollowController extends Controller
{
    //

    public function followProfile(FollowService $followService)
    {

        return $followService->followProfile();
    }

    public function countFollowers(FollowService $followService)
    {

        return $followService->countFollowers();
    }

    public function countFollowings(FollowService $followService)
    {
        return $followService->countFollowings();
    }

    public function handleFollowers($username)
    {

        $users = User::all();

        $user = User::where('username', $username)->first();
        $page_name = $user->username . " - followers";
        
        $follows = Follow::where(['profile_id' => $user->profile->id])->with("user.profile")->get();

        return view('follows.followers.index', compact('follows', 'users', 'user', 'page_name'));
        
    }

    public function handleFollowing($username)
    {
        $users = User::all();
     
        $user = User::where('username', $username)->first();
        $page_name = $user->username . " - following";

        $follows = Follow::where(['user_id' => $user->id])->with('profile.user')->get();

        return view('follows.following.index', compact('follows', 'users', 'user', 'page_name'));
    }

    public function followers($username, PostUtilService $postUtilService) {
        
        $user = $postUtilService->getUser($username);
        $followers = Follow::where(["profile_id" => $user->id])->with('user')->get();

        if (auth()->user()) {
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

        return view('follows.followers', compact('user', 'n', 'followers'));
        }
    }

    public function following($username, PostUtilService $postUtilService) {
        
        $user = $postUtilService->getUser($username);
        $following = Follow::where(["user_id" => $user->id])->with('user')->get();

        if (auth()->user()) {
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        $notifications = Notification::where(["user_id" => $user->id])->with('feed', 'comment')->orderBy("created_at", "desc")->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

        return view('follows.following', compact('user', 'n', 'following'));
        }
    }

}
