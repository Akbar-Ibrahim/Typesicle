<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHashtag extends Model
{
    //
    // protected $table = "hashtags_posts";

    protected $fillable = ['feed_id', 'hashtag_id'];
}
