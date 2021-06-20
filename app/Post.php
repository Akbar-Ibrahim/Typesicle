<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'url',
        'body',
        'likes',
        // 'is_liked',
        'shares',
        // 'is_shared',
        'is_published',
        'publish_at',
        'responding_to',
        'views',
    ];

    protected $appends = [
        'in_response_to'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function Feed()
    {
        return $this->hasOne('App\Feed');

    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    
    public function getInResponseToAttribute(){
        return Post::where(["id" => $this->responding_to])->with("user.profile", "feed")->first();
    }

    public function setUrlAttribute($value)
    {
        $spec_char = [
            "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "=", "\"", "{", "}", "[", "]", "<", ">", "?", "`", "~", "'", ",", "."
        ];

        // $char = str_replace([",", "."], "-", $value);
        $url = str_replace(' ', '-', $value);
        return $this->attributes['url'] = str_replace($spec_char, "", $url);


    }

    public function getUrlAttribute($value)
    {
        // $url = str_replace('-', ' ', $value);
        $url = $value;
        
        return $this->attributes['url'] = $url;

    }

    public function getTitleAttribute($title)
    {
        
        // return $this->attributes['url'] = ucwords($title);
        return $this->attributes['title'] = ucwords($title);

    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');

    }

    public function feedLikes(){
        return $this->hasMany('App\Like')->with('user.profile');
    }

    public function reposts(){
        return $this->hasMany('App\Repost')->with('user.profile');
    }

    

    public function is_liked()
    {
        return "";
    }

    public function is_shared()
    {
        return "";
    }

    public function is_queued(){
        return "";
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
        

    }
}
