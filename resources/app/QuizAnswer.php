<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    //

    protected $fillable = [
        'quiz_id',
        'question_id',
        'player',
        'answer'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question');

    }

    public function user()
    {
        return $this->belongsTo('App\User', 'player');
    }
}
