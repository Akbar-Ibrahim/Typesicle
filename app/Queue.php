<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    //

    protected $fillable = ['user_id', 'feed_id'];

    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function feed(){
        return $this->belongsTo('App\Feed')->with('user', 'shortie', 'post.photo', 'post.user');
    }
}
