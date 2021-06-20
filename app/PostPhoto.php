<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    //

    protected $fillable = ['user_id', 'post_id', 'photo_id'];

    

    public function feed()
    {
        return $this->belongsTo('App\Feed');

    }
    public function photo()
    {
        return $this->belongsTo('App\Photo');

    }
}
