<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortiePhoto extends Model
{
    //

    protected $fillable = ['user_id', 'shortie_id', 'photo_id'];

    public function shortie()
    {
        return $this->belongsTo('App\Shortie');

    }
    
    public function photo()
    {
        return $this->belongsTo('App\Photo');

    }
}
