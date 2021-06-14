<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //

    protected $fillable = ['user_id', 'feed_id', 'post_id', 'shortie_id', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function Feed(){
        return $this->belongsTo('App\Feed');
    }

public function shortie(){
    return $this->belongsTo('App\Shortie');
}

}