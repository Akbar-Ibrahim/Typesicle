<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FollowNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $follower; 

    public function __construct($follower)
    {
        //
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
    

        return (new MailMessage)
                   ->subject("You have a new follower")
                   ->markdown("emails.follow", ['username' =>$notifiable->name,'follower' =>$this->follower]);
              
             
    }

    // public function toDatabase($notifiable){

    //     return ['message' => $this->follower. ' followed you'];
    // }

    // public function toBroadcast($notifiable) {
    //     return new BroadcastMessage([
    //         'message' => $this->follower. ' followed you'
    //     ]);
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return ['message' => $this->follower. ' followed you'];
    }
}
