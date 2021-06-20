<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    //

    protected $f    illable = [
        'group_id', 'sender', 'message', 'attachment'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'sender')->with("profile");

    }

}
