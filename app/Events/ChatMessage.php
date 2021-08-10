<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $receiver;
    public $chat;
    public $senderChatList;
    public $receiverChatList;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $sender, $receiver, $chat, $senderChatList, $receiverChatList)
    {
        //
        $this->message = $message;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->chat = $chat;
        // $this->chatList = $chatList;
        $this->senderChatList = $senderChatList;
        $this->receiverChatList = $receiverChatList;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message-channel');
    }
}
