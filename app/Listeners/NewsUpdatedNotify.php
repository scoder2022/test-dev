<?php

namespace App\Listeners;

use App\Events\NewsUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NewsUpdatedNotify implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsUpdated $event): void
    {
        Log::info('News Updated event fired for News ID ' . $event->news->id);
    }
}
