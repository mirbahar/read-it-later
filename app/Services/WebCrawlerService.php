<?php

namespace App\Services;

use App\Models\Content;
use App\Services\HttpClient\AbstractHttpClient;
use Exception;
use Symfony\Component\DomCrawler\Crawler;
use Throwable;

class WebCrawlerService extends AbstractHttpClient
{
    /** @var Content */
    private $content;

    /** @var Crawler */
    private $crawler;

    private $title = null;

    private $excerpt = null;

    private $img = null;

    /**
     * WebCrawlerService constructor.
     * @param Content $content
     * @throws Exception
     */
    public function __construct(Content $content)
    {
        $this->content = $content;

        parent::__construct();
        $this->crawler = $this->get($this->content->url);
    }

    /**
     * Scrap title from the crawler.
     *
     * @return null|string
     */
    public function getTitle()
    {
        $this->title = $this->crawler->filter('h1')->text();

        if (empty($this->title)) {

            $this->title = $this->crawler->filter('h2')->text();
        }

        if (empty($this->title)) {
            $nodes = $this->crawler->filterXpath('//meta[@property="title"]');

            $this->title = $this->getContentData($nodes);
        }

        if (empty($this->title)) {
            $nodes = $this->crawler->filterXpath('//meta[@property="og:title"]');

            $this->title = $this->getContentData($nodes);
        }

        return $this->title;
    }

    /**
     * Scrap excerpt from the crawler.
     *
     * @return null|string
     */
    public function getExcerpt()
    {
        // by meta description
        $nodes = $this->crawler->filterXpath('//meta[@property="description"]');

        $this->excerpt = $this->getExcerptData($nodes);

        if (empty($this->excerpt)) {

            // by meta og:description
            $nodes = $this->crawler->filterXpath('//meta[@property="og:description"]');

            $this->excerpt = $this->getExcerptData($nodes);

        }

        if (empty($this->excerpt))
        {
            // From Paragraph
            $this->excerpt = $this->crawler->filter('p')->text();
        }

        return $this->excerpt;
    }

    /**
     * Scrap image from the crawler.
     *
     * @return null|string
     */
    public function getImageLink()
    {
        $image = null;

        // by meta image
        $nodes = $this->crawler->filterXpath('//meta[@property="image"]');

        $this->img = $this->getContentImageData($nodes);

        if (empty($this->img)) {
            // by meta og:image
            $nodes = $this->crawler->filterXpath('//meta[@property="og:image"]');

            $this->img = $this->getContentImageData($nodes);
        }

        if (empty($this->img)) {
            // by meta og:image:secure_url
            $nodes = $this->crawler->filterXpath('//meta[@property="og:image:secure_url"]');

            $this->img = $this->getContentImageData($nodes);
        }

        if (empty($this->img)) {
            // by image tag
            $this->img = $this->crawler->filter('image')->links();
        }

        return $this->img;
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

                $link = $parsedArray['scheme'] . '://' . $parsedArray['host'] . $link;
            }

            return $link;
        } catch (Throwable $th) {
            return null;
        }
    }

    private function getContentData($nodes)
    {
        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->attr('content'))) {
                $this->title = $dom->attr('content');
            }
        }

        return $this->title;
    }

    private function getExcerptData($nodes)
    {
        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->attr('content'))) {
                $this->excerpt = $dom->attr('content');
            }
        }

        return $this->excerpt;
    }

    private function getContentImageData($nodes)
    {
        foreach ($nodes as $node) {
            $dom = new Crawler($node);
            if (!empty($dom->attr('content'))) {
                $this->img = $this->getValidImageLink($dom->attr('content'));
            }
        }

        return $this->img;
    }

}