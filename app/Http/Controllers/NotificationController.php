<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function index() {

        $user = auth()->user();
        
        Notification::where(["user_id" => $user->id])->update(["read" => "yes"]);
        
        $notifications = Notification::where(["user_id" => $user->id])->orderBy("created_at", "desc")->get();
        

        // return $notifications;
        
        return view("notifications.index", compact("notifications", "user"));
    }
}