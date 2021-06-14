<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Poll;
use App\Vote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
        return view("poll.create", compact('user'));
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
        $input = $request->all();
        $poll = Poll::create($input);
        $user = auth()->user();
        Feed::create(["user_id" => $user->id, "poll_id" => $poll->id, "status" => "poll"]);

        return "Created";
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
        $poll = Poll::findOrFail($id);
        $user = auth()->user();
        $myVote = Vote::where(["user_id" => $user->id, "poll_id" => $poll->id])->first();

        $first_choice = $poll->first_choice;
        $second_choice = $poll->second_choice;
        $third_choice = $poll->third_choice;
        $fourth_choice = $poll->fourth_choice;
        $total = $poll->total;


        return view("poll.show", compact("user", "poll", "first_choice", "second_choice", "third_choice", "fourth_choice", "total", "myVote"));
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

        $poll_id = $request->poll_id;
        $poll = Poll::findOrFail($poll_id);
        $user = auth()->user();


        if ($request->first_choice) {

            // $poll = Poll::where(["id" => $poll_id]);
            $vote = $poll->update(["first_choice_total" => $poll->first_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll->id, "my_choice" => 1]);

            return $poll->first_choice_total . " " . $total;
        } else if ($request->second_choice) {
            $vote = $poll->update(["second_choice_total" => $poll->second_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => 2]);

            return $poll->second_choice_total . " " . $total;
        } else if ($request->third_choice) {
            $vote = $poll->update(["third_choice_total" => $poll->third_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => 3]);

            return $poll->third_choice_total . " " . $total;
        } else if ($request->fourth_choice) {
            $vote = $poll->update(["fourth_choice_total" => $poll->fourth_choice_total + 1]);
            $total = $poll->first_choice_total + $poll->second_choice_total + $poll->third_choice_total;
            $poll->update(["total" => $poll->total + $total]);
            $vote = Vote::create(["user_id" => $user->id, "poll_id" => $poll_id, "my_choice" => 4]);

            return $poll->fourth_choice_total . " " . $total;
        }
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
