<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shortie extends Model
{
    //

    protected $fillable = ['shortie', 'user_id', 'quoted', 'thread_id', 'status', 'likes', 'shares', 'commenting_on', 'replies'];

    protected $appends = [
        'quoted_shortie', "shortie_feed"
    ];

    public function shortiePhoto()
    {
        return $this->hasMany('App\ShortiePhoto');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->with('profile');
    }


    // public function quoted(){
    //     return Shortie::where(["id" => $this->quoted])->first();
    // }

    public function getQuotedShortieAttribute()
    {
        return Shortie::where(["id" => $this->quoted])->with("shortiePhoto.photo", "user.profile", "feed.shortie.user.profile")->first();
    }

    public function feed()
    {
        return $this->hasOne('App\Feed');
    }

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function feedLikes(){
        return $this->hasMany('App\Like')->with('user.profile');
    }

    public function is_liked()
    {
        return "";
    }

    public function is_shared()
    {
        return "";
    }

    public function getShortieFeedAttribute()
    {
        return $this->feed()->where(["shortie_id" => $this->id])->first();
    }

    public function my_feed () {
        return "";
    }

}
