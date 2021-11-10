<?php

namespace App\Services;

use App\Models\Content;
use App\Services\HttpClient\AbstractHttpClient;

class WebCrawlerService extends AbstractHttpClient
{
    /** @var Content */
    private $content;

    public function __construct(Content $content)
    {
        $this->content = $content;

        parent::__construct();
    }
}