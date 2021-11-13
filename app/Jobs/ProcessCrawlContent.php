<?php

namespace App\Jobs;

use App\Models\Content;
use App\Services\WebCrawlerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCrawlContent implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $content;
    /**
     * Create a new job instance.
     *
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       /* try {
            $crawler = new WebCrawlerService($this->content);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }*/
        try {

            $crawler = new WebCrawlerService($this->content);

            $this->content->update([
                'title' => $crawler->getTitle(),
                'excerpt' => $crawler->getExcerpt(),
                'image' => $crawler->getImageLink(),
            ]);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

}
