<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LikeFeed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedId;
    public $action;
    public $userId;
    public $likeCount;
    public $type = "likefeed";
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($feedId, $action, $userId, $likeCount)
    {
        //
        $this->feedId = $feedId;
        $this->action = $action;
        $this->userId = $userId;
        $this->likeCount = $likeCount;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('like-channel');
    }
}
