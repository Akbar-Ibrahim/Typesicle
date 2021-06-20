<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveQuiz extends Model
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

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');

    }

    public function analytics(){
        return $this->hasOne('App\QuizAnalytics');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');

    }


    public function user(){
        return $this->belongsTo('App\User');
    }
}
