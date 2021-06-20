<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnalytics extends Model
{
    //

    protected $fillable = [
        'quiz_id', 'creator', 'player', 'correct', 'wrong', 'unanswered', 'questions_correct', 'questions_wrong', 'questions_unanswered', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'player');


    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');

    }
}
