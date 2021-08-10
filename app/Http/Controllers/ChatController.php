<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatList;
use App\Notification;
use App\Services\PostUtilService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
  //
  public function messages() {
    
    $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
    $user = auth()->user();

    return view("chat.chat", compact("n", "user"));
  }

  public function index($username, PostUtilService $postUtilService)
  {
    $authuser = auth()->user();
    $chatlist = ChatList::where(["user" => $authuser->id])->get();
    $users = [];

    foreach($chatlist as $cl) {
      $u = User::where(["id" => $cl->chatting_with])->first();
      array_push($users, $u);
    }

    $user = $postUtilService->getUser($username);

    //   if (! Gate::allows('can-chat', $user)) {
    //     abort(403);
    // }

    $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();

    $chats = Chat::all();

    $pOne = Chat::where(["user_one" => $authuser->id, "user_two" => $user->id])->first();
    $pTwo = Chat::where(["user_one" => $user->id, "user_two" => $authuser->id])->first();
    $chatted = "";

    if ($pOne || $pTwo) {
      $chatted = "yes";
    } else {
      $chatted = "no";
    }



    return view('chat.index', compact('user', 'n', 'username', 'users', 'chatted'));
  }

  public function startChat()
  {
  }

  public function fetchChatList(){
    $authuser = auth()->user();
    $chatlist = ChatList::where(["user" => $authuser->id])->orderBy("last_message", "desc")->get();
    $users = [];

    foreach($chatlist as $cl) {
      $u = User::where(["id" => $cl->chatting_with])->first();
      $u->lastMessage = $cl->latest_message;
      array_push($users, $u);
    }
    return $users;
  }
  
  public function getChats($id) {

    $chat = Chat::where("id", $id)->first();
    return $chat;
  }
}
