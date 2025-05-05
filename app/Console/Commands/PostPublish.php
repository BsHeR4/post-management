<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PostPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command publish scheduled posts';

    /**
     * this command retrive all posts 100 after 100 
     * which it has `publish_date` (less than or equal now),
     * `is_published` field (false) 
     * then change `is_published` field to true
     */
    public function handle()
    {
        Post::where('publish_date', '<=', Carbon::now())
            ->where('is_published', false)
            ->chunkById(100, function ($posts) {
                foreach ($posts as $post) {
                    $post->update(['is_published' => true]);
                }
            });
    }
}
