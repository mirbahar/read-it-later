<?php

namespace App\Services\HttpClient;

use App\Services\Contracts\AbstractHttpClientInterface;
use Exception;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractHttpClient implements AbstractHttpClientInterface
{
    /** @var Client */
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * @param string $url
     * @return Crawler
     * @throws Exception
     */
    public function get(string $url): Crawler
    {

        try {

            Log::info('Web Site Crawling Running........');

            return  $this->httpClient->request('GET',$url);

        }catch (Exception $e) {

            Log::info($e->getMessage());

            throw new Exception('Bad Response', 500);

        } finally {

            Log::info('Web Crawling Done');
        }

    }
}
