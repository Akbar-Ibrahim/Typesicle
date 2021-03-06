<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'feed_id', 
        'post_id',
        'user_id',
        'body', 
        'is_active',
    ];

    protected $appends = [
        'date'
    ];

    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function feed()
     {
         return $this->belongsTo('App\Feed');

     }

     public function post()
     {
         return $this->belongsTo('App\Post');

     }

     public function replies()
    {
        return $this->hasMany('App\CommentReply');

    }

    public function getDateAttribute() {
        return $this->created_at->toFormattedDateString();
    }
}
