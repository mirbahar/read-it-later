<?php

namespace App\Jobs;

use App\Models\Content;
use App\Services\WebCrawlerService;
use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

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
            $client = new Client();

            $crawler = $client->request('GET', $this->content->url);

            $title = $this->scrapTitle($crawler);
            $excerpt = $this->scrapExcerpt($crawler);
            $image = $this->scrapImage($crawler);

            $this->content->update([
                'title' => $title,
                'excerpt' => $excerpt,
                'image' => $image,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }


    /**
     * Scrap title from the crawler.
     *
     * @param Crawler $crawler
     * @return null|string
     */
    private function scrapTitle(Crawler $crawler)
    {
        $title = null;

        // by h1
        $nodes = $crawler->filter('h1');

        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->text())) {
                $title = $dom->text();
                break;
            }
        }

        if (empty($title)) {
            // by h2
            $nodes = $crawler->filter('h2');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->text())) {
                    $title = $dom->text();
                    break;
                }
            }
        }

        if (empty($title)) {
            // by meta title
            $nodes = $crawler->filterXpath('//meta[@property="title"]');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('content'))) {
                    $title = $dom->attr('content');
                    break;
                }
            }
        }

        if (empty($title)) {
            // by meta og:title
            $nodes = $crawler->filterXpath('//meta[@property="og:title"]');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('content'))) {
                    $title = $dom->attr('content');
                    break;
                }
            }
        }

        return $title;
    }

    /**
     * Scrap excerpt from the crawler.
     *
     * @param Crawler $crawler
     * @return null|string
     */
    private function scrapExcerpt(Crawler $crawler)
    {
        $excerpt = null;

        // by meta description
        $nodes = $crawler->filterXpath('//meta[@property="description"]');

        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->attr('content'))) {
                $excerpt = $dom->attr('content');
                break;
            }
        }

        if (empty($excerpt)) {
            // by meta og:description
            $nodes = $crawler->filterXpath('//meta[@property="og:description"]');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('content'))) {
                    $excerpt = $dom->attr('content');
                    break;
                }
            }
        }

        if (empty($excerpt)) {
            // by paragraph
            $nodes = $crawler->filter('p');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->text())) {
                    $excerpt = $dom->text();
                    break;
                }
            }
        }

        return $excerpt;
    }

    /**
     * Scrap image from the crawler.
     *
     * @param Crawler $crawler
     * @return null|string
     */
    private function scrapImage(Crawler $crawler)
    {
        $image = null;

        // by meta image
        $nodes = $crawler->filterXpath('//meta[@property="image"]');

        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->attr('content'))) {
                $image = $this->getValidImageLink($dom->attr('content'));
                break;
            }
        }

        if (empty($image)) {
            // by meta og:image
            $nodes = $crawler->filterXpath('//meta[@property="og:image"]');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('content'))) {
                    $image = $this->getValidImageLink($dom->attr('content'));
                    break;
                }
            }
        }

        if (empty($image)) {
            // by meta og:image:secure_url
            $nodes = $crawler->filterXpath('//meta[@property="og:image:secure_url"]');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('content'))) {
                    $image = $this->getValidImageLink($dom->attr('content'));
                    break;
                }
            }
        }

        if (empty($image)) {
            // by image tag
            $nodes = $crawler->filter('img');

            foreach ($nodes as $node) {
                $dom = new Crawler($node);
                if (!empty($dom->attr('src'))) {
                    $image = $this->getValidImageLink($dom->attr('src'));
                    break;
                }
            }
        }

        return $image;
    }

    /**
     * Get valid image link.
     *
     * @param string $link
     * @return string|null
     */
    private function getValidImageLink(string $link)
    {
        try {
            if (!filter_var($link, FILTER_VALIDATE_URL)) {
                $parsedArray = parse_url($this->content->url);

                $link = $parsedArray['scheme'].'://'.$parsedArray['host'].$link;
            }

            return $link;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
