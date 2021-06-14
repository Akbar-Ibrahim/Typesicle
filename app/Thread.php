<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shortie;

class Thread extends Model
{
    //
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');

    }


    public function shorties()
    {
        return $this->hasMany('App\Shortie')->with('shortiePhoto.photo', 'user.profile', 'thread.feed');
        
        
    }

    public function shortie($id)
    {
        return Shortie::where(["id" => $id])->first();
        
    }

    public function Feed()
    {
        return $this->hasOne('App\Feed');

    }

}
