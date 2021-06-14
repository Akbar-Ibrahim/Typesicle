<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    protected $fillable = [
        'user_id', 'bio', 'picture', 
     ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function follows(){
        return $this->hasMany('App\Follow');
    }
}
