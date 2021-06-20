<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = ['profile_id', 'user_id', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function profile(){
        return $this->belongsTo('App\Profile');
    }
}
