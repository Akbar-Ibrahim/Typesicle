<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Queue;
use App\Services\PostUtilService;
use App\Services\QueueService;
use App\User;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QueueService $queueService, PostUtilService $postUtilService)
    {
        //
        $user = auth()->user();
        // $user = $postUtilService->getUser($username);
        $history = $queueService->getQueues($user);
        // $queues = Queue::where(['user_id' => auth()->user()->id])->with('user.profile', 'feed.post')->get();
        $n = Notification::where(["user_id" => auth()->user()->id, "read" => "no"])->get();
        
        return view("queue.index", compact("history", "user", "n"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, QueueService $queueService)
    {
        //
        return $queueService->saveToQueue();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, QueueService $queueService)
    {
        //
        $user = auth()->user();
        return redirect()->back();
        return Queue::where('user_id', $user->id)->delete();
    }
}
