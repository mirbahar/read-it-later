<?php

namespace App\Listeners;

use App\Events\ContentProcessed;
use App\Jobs\ProcessCrawlContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WebScraper
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContentProcessed  $event
     * @return void
     */
    public function handle(ContentProcessed $event)
    {
        ProcessCrawlContent::dispatch($event->content);
    }
}
