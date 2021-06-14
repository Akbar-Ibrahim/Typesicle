<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Queue;

class QueueService
{
    public function saveToQueue(){

        $feed_id = request()->feed_id;
        $user = auth()->user();       

            $queue = Queue::create(['feed_id' => $feed_id, 'user_id' => $user->id]);
            
    }

    public function getQueues($user){

        // $user = auth()->user();

        return Queue::where(['user_id' => $user])->get();
    }

    public function deleteFromQueue(){

        $feed_id = request()->feed_id;
        $user = auth()->user();
        
        Queue::where('feed_id', $user->id)->delete();

            
    }

}
