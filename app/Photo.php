<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $directory = "/images/";

    protected $fillable = ['user_id', 'photo', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function profile(){
        return $this->hasOne('App\Profile');
    }


    public function shortiePhoto(){
        return $this->hasOne('App\ShortiePhoto');
    }
}
