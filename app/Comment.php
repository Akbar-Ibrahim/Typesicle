<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'feed_id', 
        'user_id',
        'body', 
        'is_active',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function feed()
     {
         return $this->belongsTo('App\Feed');

     }

     public function replies()
    {
        return $this->hasMany('App\CommentReply');

    }
}
