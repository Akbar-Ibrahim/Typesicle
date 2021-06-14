<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FollowService;

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

}
