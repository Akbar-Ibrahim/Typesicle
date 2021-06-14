<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //

    protected $fillable = ['name', 'url', 'user_id'];

    public function posts(){
        return $this->hasMany('App\Post')->with('feed.post.photo', 'feed.user.profile');
    }

    public function feeds(){
        return $this->hasMany('App\Feed')->with('post.photo', 'shortie.shortiePhoto.photo', 'post.user', 'user.profile');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function scopePostCountTen($query){

            return ($query)->whereHas('feeds', function($query){
                return $query-> select(DB::raw('count(*) as num_post,category_id') )->groupby('category_id')
                ->havingRaw( DB::raw( 'num_post >= 2'));
            });
            
        }


    public function setUrlAttribute($value)
    {
        $spec_char = [
            "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "=", "\"", "{", "}", "[", "]", "<", ">", "?", "`", "~", "'", ",", "."
        ];

        // $dashes = str_replace("--", "-", $value);
        $url = str_replace(' ', '-', $value);
        return $this->attributes['url'] = str_replace($spec_char, "", $url);

    }

    public function getUrlAttribute($value)
    {

        $url = $value;
        return $this->attributes['url'] = $url;
    }
}
