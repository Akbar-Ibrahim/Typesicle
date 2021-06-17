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

        $queues = Queue::where(['user_id' => $user->id])->with('feed.user', 'feed.shortie', 'feed.post')->orderBy('created_at', 'desc')->get();
        
        $result = [];

            foreach ($queues as $q) {
                if ($q->feed->post) {
                if (auth()->user()->isLiked($q->feed->post_id)) {
                    $q->feed->post->is_liked = 1;
                } else {
                    $q->feed->post->is_liked = 0;
                }

                if (auth()->user()->isReposted($q->feed->post_id)) {
                    $q->feed->post->is_shared = 1;
                } else {
                    $q->feed->post->is_shared = 0;
                }

                if (auth()->user()->isQueued($q->feed->post_id)) {
                    $q->feed->post->is_queued = 1;
                } else {
                    $q->feed->post->is_queued = 0;
                }
                array_push($result, $q);
            } 
            }

            return $result;

        // return Queue::where(['user_id' => $user])->get();
    }

    public function deleteFromQueue(){

        $feed_id = request()->feed_id;
        $user = auth()->user();
        
        Queue::where('feed_id', $user->id)->delete();

            
    }

}
