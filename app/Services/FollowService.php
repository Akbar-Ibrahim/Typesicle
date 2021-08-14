<?php
namespace App\Services;

use App\Events\FollowEvent;
use App\Events\NewPostEvent;
use App\Events\NotificationEvent;
use Illuminate\Http\Request;
use App\Follow;
use App\Mail\FollowNotificationEmail;
use App\Notification;
use App\Notifications\FollowNotification;
use Illuminate\Support\Facades\Mail;


class FollowService
{
    public function followProfile(){


        $profile_id = request()->profileId;
        $user = auth()->user();
        $status = request()->status;
        $check = Follow::where(['profile_id' => $profile_id, 'user_id' => $user->id])->first();
        if($check == null){
            $follow = Follow::create(['profile_id' => $profile_id, 'user_id' => $user->id, 'status' => $status]);

                $user_followed = $follow->profile->user;
                $follower_name = $user->username;
                
                // $user_followed->notify(new FollowNotification($follower_name));


                Notification::create(["user_id" => $profile_id, "type" => "follow", "notifier" => $user->id, "message" => "followed you", "read" => "no"]);
                $myNotifications = Notification::where(["user_id" => $profile_id, "read" => "no"])->get();
        

                $count = $myNotifications->count();
                broadcast(new NotificationEvent($count, $profile_id))->toOthers();

                $getFollowers = Follow::where(["profile_id" => $profile_id])->get();
                $followerCount = $getFollowers->count();
                broadcast(new FollowEvent($followerCount, $profile_id, $user->id))->toOthers();

                return $follow->load('profile.user');

        }else{
            Follow::where(['profile_id' => $profile_id, 'user_id' => $user->id])->delete();

                $getFollowers = Follow::where(["profile_id" => $profile_id])->get();
                $followerCount = $getFollowers->count();
                broadcast(new FollowEvent($followerCount, $profile_id, $user->id))->toOthers();
            
        }

        
    }

    public function countFollowers() {

        $id = request()->id;
        $followers = Follow::where(["profile_id" => $id])->get();
        return $followers->load('user');
    }

    
    public function countFollowings() {

        $id = request()->id;
        $followings = Follow::where(["user_id" => $id])->with("profile.user")->get();
        return $followings;
    }
}
