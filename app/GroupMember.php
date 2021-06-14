<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    //
    protected $fillable = [
    'group_id', 'user_id', 'type', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function group()
    {
        return $this->belongsTo('App\Group');

    }

    public function myGroup($id) {
        // return Group::where(["id" => $id])->first();
        return $this->group()->where(['id' => $id])->first();
    }
}
