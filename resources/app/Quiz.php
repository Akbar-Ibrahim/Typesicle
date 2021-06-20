<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //

    protected $fillable = [
        'user_id', 'title', 'description', 'status'
    ];

    public function questions(){
        return $this->hasMany('App\Questions');
    }

    public function savedQuizzes(){
        return $this->hasMany('App\SaveQuiz');
    }

    public function analytics(){
        return $this->hasOne('App\QuizAnalytics');
    }
}
