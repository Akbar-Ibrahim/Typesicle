<?php
namespace App\Services;

use App\PlayerStat;
use App\QuizAnalytics;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class QuizService{
    
    
    public function playStatus() {

        $user_id = request()->user_id;
        $quiz_id = request()->quiz_id;
        $player = QuizAnalytics::where(["quiz_id" => $quiz_id, 'player' => $user_id])->first();

        if ($player){
            return $player;
        }
        return ["error" => "Not Played"];
    }
}

?>