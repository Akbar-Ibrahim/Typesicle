<?php

namespace App\Http\Controllers;

use App\Poll;
use App\Vote;
use Illuminate\Http\Request;

class PollUtilController extends Controller
{
    //

    public function vote(Request $request)
    {
        //

        $poll_id = $request->poll_id;
        $poll = Poll::findOrFail($poll_id);
        $user = auth()->user();


        if ($request->first_choice) {

            $vote = $poll->update(["first_choice_total" => $poll->first_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll->id, "my_choice" => $poll->first_choice]);

            // return $poll->first_choice_total . " " . $total;
            return $vote;
        } else if ($request->second_choice) {
            $vote = $poll->update(["second_choice_total" => $poll->second_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => $poll->second_choice]);

            // return $poll->second_choice_total . " " . $total;
            return $vote;
        } else if ($request->third_choice) {
            $vote = $poll->update(["third_choice_total" => $poll->third_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => $poll->third_choice]);

            // return $poll->third_choice_total . " " . $total;
            return $vote;
        } else if ($request->fourth_choice) {
            $vote = $poll->update(["fourth_choice_total" => $poll->fourth_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => $poll->fourth_choice]);

            // return $poll->fourth_choice_total . " " . $total;
            return $vote;
        }
    }

    public function myVote($poll_id){

        // $poll = Poll::findOrFail($poll_id);
        $poll = Poll::where(["id" => $poll_id])->first();
        $user = auth()->user();

        if ($user->hasVoted($poll->id)) {
        $vote = Vote::where(["user_id" => $user->id, "poll_id" => $poll->id])->first();

        if ($vote->my_choice == 1) {
            return $poll->first_choice;
        } else if ($vote->my_choice == 2) {
            return $poll->second_choice;
        } else if ($vote->my_choice == 3) {
            return $poll->thirdd_choice;
        } else if ($vote->my_choice == 4) {
            return $poll->fourth_choice;
        }

        } else {
            return "";
        }
        
        
    }
}
