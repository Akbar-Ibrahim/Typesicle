<?php

namespace App\Jobs;

use App\Feed;
use App\Post;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $currentDateTime = Carbon::now()->toDateTimeString();
        // $newDateTime = Carbon::now()->addMinutes(2)->toDateTimeString();

        $unpublishedPosts = Post::where("is_published", "no")->get();
        
        foreach ($unpublishedPosts as $post) {
        if ($post->publish_at == $currentDateTime){
            $post->update(["is_published" => "yes"]);
        }
    }
    }
}
