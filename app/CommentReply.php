<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //

    protected $fillable = [
        'comment_id', 
        'user_id',
        'body', 
        'is_active',
    ];

    protected $appends = [
        'date'
    ];
    
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getDateAttribute() {
        return $this->created_at->toFormattedDateString();
    }

}
