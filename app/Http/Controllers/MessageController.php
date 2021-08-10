<?php

namespace App\Http\Controllers;

use App\Chat;
use App\ChatList;
use App\Events\ChatMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
  //
  public function fetchMessages(Request $request)
  {
    $pOne = Chat::where(["user_one" => $request->user_one, "user_two" => $request->user_two])->first();
    $pTwo = Chat::where(["user_one" => $request->user_two, "user_two" => $request->user_one])->first();

    if ($pOne || $pTwo) {
      return Message::where(["chat_id" => $pOne ? $pOne->id : $pTwo->id])->with('user')->get();
    } else {
      return ["message" => ":)"];
    }
  }

  public function sendMessage(Request $request)
  {
    $user = Auth::user();
    $receiver = User::where(["id" => $request->user_two])->first();

    $pOne = Chat::where(["user_one" => $request->user_one, "user_two" => $request->user_two])->first();
    $pTwo = Chat::where(["user_one" => $request->user_two, "user_two" => $request->user_one])->first();

// update chatlist with last_message

    if ($pOne || $pTwo) {
      $message = $user->messages()->create([
        'chat_id' => $pOne ? $pOne->id : $pTwo->id,
        'message' => $request->input('message')
      ]);


      $chat = $pOne ? $pOne : $pTwo;

      $chatlistR = ChatList::where(["user" => $request->user_two])->orderBy("last_message", "desc")->get();
      $chatlistS = ChatList::where(["user" => $request->user_one])->orderBy("last_message", "desc")->get();

      ChatList::where("chat_id", $chat->id)->update(['last_message' => $message->created_at]);

      $receiverChatList = [];
      $senderChatList = [];

      if ($chatlistR->count() > 0) {
        foreach ($chatlistR as $cl) {
          $u = User::where(["id" => $cl->chatting_with])->first();
          $u->lastMessage = $cl->latest_message;
          array_push($receiverChatList, $u);
        }
      }

      if ($chatlistS->count() > 0) {
        foreach ($chatlistS as $cl) {
          $u = User::where(["id" => $cl->chatting_with])->first();
          $u->lastMessage = $cl->latest_message;
          array_push($senderChatList, $u);
        }
      }

      broadcast(new ChatMessage($message, $user, $receiver, $chat, $senderChatList, $receiverChatList))->toOthers();
      $result = $message->load("user");
      return $result;
    } else {
      $chat = Chat::create(["user_one" => $request->user_one, "user_two" => $request->user_two]);
      $message = $user->messages()->create([
        'chat_id' => $chat->id,
        'message' => $request->input('message')
      ]);

      ChatList::create(["chat_id" => $chat->id,  "user" => $request->user_one, "chatting_with" => $request->user_two, "last_message" => $message->created_at]);
      ChatList::create(["chat_id" => $chat->id, "user" => $request->user_two, "chatting_with" => $request->user_one, "last_message" => $message->created_at]);

      $chatlistR = ChatList::where(["user" => $request->user_two])->orderBy("last_message", "desc")->get();
      $chatlistS = ChatList::where(["user" => $request->user_one])->orderBy("last_message", "desc")->get();
      $receiverChatList = [];
      $senderChatList = [];

      if ($chatlistR->count() > 0) {
        foreach ($chatlistR as $cl) {
          $u = User::where(["id" => $cl->chatting_with])->first();
          $u->lastMessage = $cl->latest_message;
          array_push($receiverChatList, $u);
        }
      }

      if ($chatlistS->count() > 0) {
        foreach ($chatlistS as $cl) {
          $u = User::where(["id" => $cl->chatting_with])->first();
          $u->lastMessage = $cl->latest_message;
          array_push($senderChatList, $u);
        }
      }

      broadcast(new ChatMessage($message, $user, $receiver, $chat, $senderChatList, $receiverChatList))->toOthers();
      $result = $message->load("user");
      return $result;
    }
  }
}
