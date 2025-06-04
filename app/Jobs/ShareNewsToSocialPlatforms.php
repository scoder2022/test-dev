<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;


class ShareNewsToSocialPlatforms implements ShouldQueue
{
    public $news;

    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Execute the job.
     */

    public function handle(): void
    {
        Log::info("News ID {$this->news->id} shared to social platforms.");
    }
}
