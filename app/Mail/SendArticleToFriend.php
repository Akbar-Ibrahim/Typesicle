<?php

namespace App\Mail;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendArticleToFriend extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;
    public $route;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, $route)
    {
        //
        $this->post = $post;
        $this->route = $route;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.posts.article');
        return $this->markdown('emails.posts.article', [
            'post' => $this->post,

        ]);
    }
}
