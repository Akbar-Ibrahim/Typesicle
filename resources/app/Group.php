<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    protected $fillable = [
        'name', 'description', 'image', 'creator', 'message', 'num_of_members'
    ];

    // protected $appends = [
    //     'members'
    // ];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class)->orderBy('created_at', 'DESC');
    }

    public function members() {
        return $this->hasMany("App\GroupMember")->where(["status" => "joined"])->with("user.profile");
        // return GroupMember::where(["group_id" => $this->id])->with("user.profile")->get();
    }
}
