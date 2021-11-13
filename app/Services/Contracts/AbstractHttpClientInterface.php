<?php

namespace App\Services\Contracts;

use App\Services\HttpClient\AbstractHttpClient;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

interface AbstractHttpClientInterface
{
    public function get(string $uri): Crawler;
}
