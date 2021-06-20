<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hashtag extends Model
{
    //
    protected $fillable = ['hashtag'];
    protected $appends = ['stripped_hashtag'];


    public function feed()
    {
        return $this->belongsToMany(Feed::class, 'post_hashtags')->with('user.profile', 'shortie.shortiePhoto.photo', 'post.photo')->orderBy('created_at', 'desc');
    }

    public function scopeGetTopHashtags($query){

        return ($query)->whereHas('feed', function($query){
            return $query-> select(DB::raw('count(*) as num_post,hashtag_id') )->groupby('hashtag_id')
            ->havingRaw( DB::raw( 'num_post >= 2'));
        });
        
       
       
    }

    public function setHashtagAttribute($value)
    {
        return $this->attributes['hashtag'] = str_replace(".", "", $value);
    }

    public function getStrippedHashtagAttribute(){
        return str_replace("#", "", $this->hashtag);
    }
}
