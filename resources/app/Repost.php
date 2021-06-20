<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    //

    protected $fillable = ['user_id', 'feed_id', 'post_id', 'shortie_id', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function feed(){
        return $this->belongsTo('App\Feed');
    }
}
