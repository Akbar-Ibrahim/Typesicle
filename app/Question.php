<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

    protected $fillable = ['quiz_id', 
    'question', 
    'option_one', 
    'option_two', 
    'option_three', 
    'option_four', 
    'correct_answer', 
    'image'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function quizAnswer()
    {
        return $this->hasOne('App\QuizAnswer');

    }

    public function playerAnswer($user_id)
    {
        return $this->quizAnswer()->where(['question_id' => $this->id, 'player' => $user_id])->first();

    }

}
