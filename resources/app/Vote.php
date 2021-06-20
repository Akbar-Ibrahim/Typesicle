<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = ["user_id", "poll_id", "my_choice"];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function Poll(){
        return $this->belongsTo('App\Poll');
    }
}
