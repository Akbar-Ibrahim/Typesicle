<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Question;
use App\Quiz;
use App\QuizAnalytics;
use App\SaveQuiz;
use App\Services\PostUtilService;
use App\User;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username, PostUtilService $postUtilService)
    {
        //
        $user = $postUtilService->getUser($username);
        $quizzes = Quiz::where(['user_id' => $user->id])->orderBy("id")->get();
        $saved = SaveQuiz::where("quiz_id", $user->id)->get();

        return view("quiz.index", compact('user', 'quizzes', 'saved'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("quiz.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $questions = $request->except(['_token']);
        $myQuestions = count($questions);
        $questionCount = $request->questionCount;
        $data = $request->all();
        $user = auth()->user();
        
        

        if ($request->status == "done") {
            if($request->has("quiz_id")){
                $quiz = Quiz::where(["id" => $request->quiz_id])->first();
                $quiz->update(["title" => $request->title, "description" => $request->description, "status" => "done"]);
                SaveQuiz::where("quiz_id", $quiz->id)->delete();
            } else {
            $quiz = Quiz::create(["user_id" => $user->id, "title" => $request->title, "description" => $request->description, 'status' => $request->status]);
            }
        for ($i = 0; $i < $questionCount; $i++) {
            $question = Question::create([
                "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                'image' => $data[$i . "image"]

            ]);
        }

            Feed::create(["user_id" => auth()->user()->id, "status" => "Quiz", "quiz_id" => $quiz->id]);
        } else {

            if($request->has("quiz_id")){

            $quiz = Quiz::where(["id" => $request->quiz_id])->first();
            $quiz->update(["title" => $request->title, "description" => $request->description]);
            // $quiz->delete();
            SaveQuiz::where('quiz_id', $request->quiz_id)->delete();
            for ($i = 0; $i < $questionCount; $i++) {
                
                $question = SaveQuiz::create([
                    "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                    "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                    'image' => $data[$i . "image"]
    
                ]);
                } 
            } else {
                $quiz = Quiz::create(["user_id" => $user->id, "title" => $request->title, "description" => $request->description, 'status' => $request->status]);
                for ($i = 0; $i < $questionCount; $i++) {
                
                    $question = SaveQuiz::create([
                        "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                        "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                        'image' => $data[$i . "image"]
        
                    ]);
            }
            }

    }
    return redirect("/" . auth()->user()->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $quiz = Quiz::findOrFail($id);
        $user = auth()->user();
        
        $questions = Question::where(['quiz_id' => $quiz->id])->with("quizAnswer")->get();
        $player = QuizAnalytics::where(["quiz_id" => $quiz->id, 'player' => $user->id])->first();
        $players = QuizAnalytics::where(["quiz_id" => $quiz->id])->get();
        $creator = User::where(["id" => $quiz->user_id])->with("profile.photo")->first();
        
        if($quiz->status == "done"){
            return view("quiz.show", compact("quiz", "player", "questions", "players", "user", "creator"));
        } else {
            return "Eyes!";
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = auth()->user();
        $quiz = Quiz::findOrFail($id);
        
         $firstQuestion = SaveQuiz::where(["quiz_id" => $id])->first();
         $questions = SaveQuiz::where(["quiz_id" => $quiz->id])->orderBy("id")->get();

        if($user->id == $quiz->user_id){    
            return view("quiz.edit", compact("quiz", "questions", "firstQuestion"));
        } else {
            return "Nice try...";
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $questions = $request->except(['_token']);
        $myQuestions = count($questions);
        $questionCount = $request->questionCount;
        $data = $request->all();
        $user = auth()->user();
        
        

        if ($request->status == "done") {
            if($request->has("quiz_id")){
                $quiz = Quiz::where(["id" => $request->quiz_id])->first();
                $quiz->update(["title" => $request->title, "description" => $request->description, "status" => "done"]);
                SaveQuiz::where("quiz_id", $quiz->id)->delete();
            } else {
            $quiz = Quiz::create(["user_id" => $user->id, "title" => $request->title, "description" => $request->description, 'status' => $request->status]);
            }
        for ($i = 0; $i < $questionCount; $i++) {
            $question = Question::create([
                "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                'image' => $data[$i . "image"]

            ]);
        }

            Feed::create(["user_id" => auth()->user()->id, "status" => "Quiz", "quiz_id" => $quiz->id]);
        } else {

            if($request->has("quiz_id")){

            $quiz = Quiz::where(["id" => $request->quiz_id])->first();
            $quiz->update(["title" => $request->title, "description" => $request->description]);
            // $quiz->delete();
            SaveQuiz::where('quiz_id', $request->quiz_id)->delete();
            for ($i = 0; $i < $questionCount; $i++) {
                
                $question = SaveQuiz::create([
                    "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                    "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                    'image' => $data[$i . "image"]
    
                ]);
                } 
            } else {
                $quiz = Quiz::create(["user_id" => $user->id, "title" => $request->title, "description" => $request->description, 'status' => $request->status]);
                for ($i = 0; $i < $questionCount; $i++) {
                
                    $question = SaveQuiz::create([
                        "quiz_id" => $quiz->id, "question" => $data[$i . 'question'], "option_one" => $data[$i . "optionInput1"], "option_two" => $data[$i . "optionInput2"],
                        "option_three" => $data[$i . "optionInput3"], "option_four" => $data[$i . "optionInput4"], "correct_answer" => $data[$i . "correctAnswer"],
                        'image' => $data[$i . "image"]
        
                    ]);
            }
            }

    }
    return redirect("/" . auth()->user()->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
