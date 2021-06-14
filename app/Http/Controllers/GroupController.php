<?php

namespace App\Http\Controllers;

use App\Events\GroupEvent;
use App\Follow;
use App\Group;
use App\GroupMember;
use App\GroupMessage;
use App\Services\AccountService;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //

    public function index() {

        $user = auth()->user();
        $groups = GroupMember::where(["user_id" => $user->id])->with("group.messages")->get();
// return $groups;
        return view("groups.index", compact("user", "groups"));
    }

    public function create() {

        $user = auth()->user();

        return view("groups.create", compact("user"));
    }

    public function createGroup(Request $request){

        $user = auth()->user();
        
        $group = Group::create(["name" => $request->name, "description" => $request->description, "creator" => $user->id]);
        $member = GroupMember::create(["group_id" => $group->id, "user_id" => $user->id, "type" => "admin"]);
        

        return redirect("/group/" . $group->id);
        // return view("groups.group", compact("group", "user"));

    }

    public function group($id, AccountService $accountService) {

        $user = auth()->user();
        $followers = Follow::where(["profile_id" => $user->id])->with("user.profile")->get();
        $members = GroupMember::where(["group_id" => $id])->get();
        $group = Group::where(["id" => $id])->with("user.profile", "members")->first();
        $chat = GroupMessage::where(["group_id" => $id])->with("user.profile")->get();
        $accounts = $accountService->followers($group->creator);
        

        $addToGroup = [];

    foreach($followers as $follower) {
        if (!$follower->user->belongsToGroup($id) ) {
            $follower->user->query_status = "no";
            array_push($addToGroup, $follower);
        } else {
            $follower->user->query_status = "yes";
            array_push($addToGroup, $follower);
        }
    }

    // return $addToGroup;

        return view("groups.group", compact("group", "user", "chat", "accounts", "followers", "addToGroup"));
        
    }

    public function addToGroup() {

    }

    public function sendChat(Request $request) {

        $user = auth()->user();
        $group = Group::where(["id" => $request->group_id])->first();
        $message = GroupMessage::create(["group_id" => $request->group_id, "sender" => $user->id, "message" => $request->message]);

        $result = $message->load("user.profile");
        
        broadcast(new GroupEvent($group->id, $user->id, $message));

        return $result;
    }
}
