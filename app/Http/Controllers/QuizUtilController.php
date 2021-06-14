<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizAnalytics;
use App\QuizAnswer;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizUtilController extends Controller
{
    //

    public function quizStats($id)
    {

        $quiz = Quiz::findOrFail($id);
        $user = auth()->user();
        $total = $quiz->correct + $quiz->wrong + $quiz->unanswered;

        $stats = QuizAnalytics::where(['creator' => $user->id, 'quiz_id' => $quiz->id])->with('user')->get();

        return view("quiz.stats", compact("quiz", "user", 'stats', 'total'));
    }

    public function playerAnswer(Request $request){

        $data = $request->except(['_token', 'creator', 'quiz_id']);

        $creator = $request->creator;
        $quiz_id = $request->quiz_id;

        $quiz = Quiz::find($quiz_id);
        $user = auth()->user();        

        for ($i = 0; $i < count($data); $i++) {
            QuizAnswer::create(["quiz_id" => $quiz->id, "player" => $user->id, "answer" => "Answer"]);
        }
    }

    public function playStatus(QuizService $quizService) {

        return $quizService->playStatus();
    }

    public function play($id) {
        return "hello";
    }

    public function newQuiz(){
        return view("quiz.new");
    }


}
