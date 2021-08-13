<?php

namespace App;

use App\Like;
use Illuminate\Database\Eloquent\Model;


class Feed extends Model
{
    //
    
    protected $fillable = ['user_id', 
    'post_id', 
    'category_id',
    'status', 
    'reposted',
    'repost_message', 
    'quiz_id', 
    'likes', 
    'views', 
    'shortie_id',
    'thread_id',
    'poll_id',
    'shares',
    'quotes',
    // 'is_liked',
    // 'is_shared'
    // 'quoted',
];


protected $appends = [
    'date'
];
    
    // protected static function boot(){
    //     parent::boot();

    //     static::created(function ($feed) {
    //         $feed->view()->create([
    //             'user_id' => $feed->user->id,
    //             'feed_id' => $feedp->id,
    //         ]);
    //     });

    // }

    public function user()
    {
        return $this->belongsTo('App\User')->with('profile');

    }

    public function post(){
        return $this->belongsTo('App\Post')->with('feed.feedLikes', 'feed.reposts', 'category');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function shortie(){
        return $this->belongsTo('App\Shortie')->with('user.profile', 'feed.thread', 'thread.feed', "shortiePhoto");
    }

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function poll(){
        return $this->belongsTo('App\Poll')->with('user.profile', 'votes');
    }

    public function history() {
        return $this->hasMany('App\History');
    }

    public function feedLikes(){
        return $this->hasMany('App\Like')->with('user.profile');
    }

    // public function view()
    // {
    //     return $this->hasOne('App\View');
    // }

    public function queues()
    {
        return $this->hasMany('App\Queue')->orderBy('created_at', 'asc');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
        // return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');

    }

    public function reposts(){
        return $this->hasMany('App\Repost')->with('user.profile');
    }

    public function postPhoto()
    {
        return $this->hasMany('App\PostPhoto');
    }

    public function thread(){
        return $this->belongsTo('App\Thread')->with('shorties.shortiePhoto.photo', 'feed');
    }

    public function setLikedAttribute($value)
    {
        return $this->attributes['liked'] = "@" . $value;
    }

    // public function getLikedAttribute($value){
    //     return $this->attributes['liked'] = $value;
        
    // }

    // public function getQuotedFeedAttribute(){
    //     return Feed::where(["id" => $this->quoted])->with("post.user.profile", "post.photo", "feedLikes', 'reposts")->first();
    // }


    public function getDateAttribute() {
        return $this->created_at->toFormattedDateString();
    }

}
