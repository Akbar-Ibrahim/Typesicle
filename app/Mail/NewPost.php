<?php

namespace App\Mail;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPost extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;
    public $user;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user, $url)
    {
        //
        $this->post = $post;
        $this->user = $user;
        $this->url = $url;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.new', [
            'author' => $this->post->user->name,
            'title' => $this->post->title,
            // 'url' => $this->post->url,
        ]);
    }
}
