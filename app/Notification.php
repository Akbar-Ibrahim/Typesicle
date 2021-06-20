<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notification extends Model
{
    //
    protected $fillable = ['user_id', 'type', 'notifier', 'message', 'read', 'post_id', 'comment_id', 'comment_reply_id'];

    protected $appends = ['date'];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function notifications($user_id) {
        return Notification::where(["user_id" => $useer->id])->get();
    }

    public function unreadNotifications() {
        return $this->notifications()->where([])->get();
    }

    
    public function getIsNotifierAttribute(){
        
        return User::where(["id" => $this->notifier])->first();
    }

    // public function getPostAttribute(){
    //     return Post::where(["id" => $this->post_id])->with("feed")->get();
    // }

    // public function getCommentAttribute() {
    //     return Comment::where(["id" => $this->comment_id])->with("feed")->get();
    // }

    // public function getCommentReplyAttribute() {
    //     return CommentReply::where(["id" => $this->comment_reply_id])->with("feed")->get();
    // }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function comment() {
        return $this->belongsTo('App\Comment');
    }

    public function commentReply() {
        return $this->belongsTo('App\CommentReply');
    
}

public function getDateAttribute() {
    return $this->created_at->diffForHumans();
}
}