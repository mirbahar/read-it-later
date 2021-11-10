<?php

namespace App\Services\HttpClient;

use App\Services\Contracts\AbstractHttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractHttpClient implements AbstractHttpClientInterface
{
    /** @var Client */
    private $httpClient;

    /**
     *@param $data
     */
    private $data   = [];

    /**
     *@param $data
     */
    private $params = [];

    /**
     *@param $data
     */
    private $header = [];

    public function __construct()
    {
        $this->httpClient = new Client();
    }


    public function withJson(array $data): AbstractHttpClient
    {
        $this->params = $data;

        return $this;
    }
    public function withHeaders(array $header): AbstractHttpClient
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @param string $uri
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function post(string $uri): ResponseInterface
    {
        $this->data['headers'] = $this->header;
        $this->data['json']    = $this->params;

        return $this->httpClient->post($uri, $this->data);
    }

    /**
     * @param string $uri
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $uri): ResponseInterface
    {
        return  $this->httpClient->get($uri, ['headers' => $this->header]);
    }
}
