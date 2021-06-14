<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    //
    protected $fillable = [
        'user_id', 'question', 'first_choice', 'second_choice', 'third_choice', 'fourth_choice', 'first_choice_total',
        'second_choice_total', 'third_choice_total', 'fourth_choice_total', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function votes(){
        return $this->hasMany('App\Vote');
    }

    public function feed()
    {
        return $this->hasOne('App\Feed');
    }
}
