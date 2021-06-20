<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    //

    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body',
        'responding_to',

    ];

    public function photo()
    {
        return $this->belongsTo('App\Photo');

    }
    
    public function user()
    {
        return $this->belongsTo('App\User');


    }

    public function category()
    {
        return $this->belongsTo('App\Category');


    }
}
