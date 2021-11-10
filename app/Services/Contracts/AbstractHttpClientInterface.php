<?php

namespace App\Services\Contracts;

use App\Services\HttpClient\AbstractHttpClient;
use Psr\Http\Message\ResponseInterface;

interface AbstractHttpClientInterface
{
    public function withJson(array $param): AbstractHttpClient;

    public function withHeaders(array $headers): AbstractHttpClient;

    public function post(string $uri): ResponseInterface;

    public function get(string $uri): ResponseInterface;
}
