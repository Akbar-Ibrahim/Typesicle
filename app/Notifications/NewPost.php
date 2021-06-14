<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPost extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $author; 
    // public $title;
    public $url;
    public $post;
    
    public function __construct($author, $post, $url)
    {
        //
        $this->author = $author;
        $this->post = $post;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)->markdown('emails.newpost');
        return (new MailMessage)
                   ->subject("New Post")
                   ->markdown("emails.newpost", ['username' => $notifiable->name,'author' => $this->author, 'post' => $this->post, 'url' => $this->url]);
    }

    public function toDatabase($notifiable){

        return ['message' => $this->follower. ' has published a new post'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
