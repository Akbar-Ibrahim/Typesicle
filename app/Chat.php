<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //

    protected $fillable = ['user_one', 'user_two'];

    protected $appends = ['latest_message'];

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'DESC');
    }

    public function getLatestMessageAttribute()
{
    $message = Message::where(["chat_id" => $this->id])->orderBy("created_at", "desc")->limit(1)->first();
        return $message->message;
    
}

public function chatList() {
    return $this->hasMany('App\ChatList');
}
}
