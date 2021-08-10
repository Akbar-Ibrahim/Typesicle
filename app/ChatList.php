<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatList extends Model
{
    //
    protected $fillable = ['chat_id', 'user', 'chatting_with', 'last_message'];

    protected $appends = ['latest_message'];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function chat()
    {
        return $this->belongsTo('App\Chat');

    }

    public function getLatestMessageAttribute() {
        $message = Message::where(["chat_id" => $this->chat_id])->orderBy("created_at", "desc")->limit(1)->first();
        return $message->message;
    }    
}
