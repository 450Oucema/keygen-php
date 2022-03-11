<?php

namespace KeygenClient\Http\Request;

use KeygenClient\Http\Client\HttpClient;
use KeygenClient\Security\Authentication;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RequestBuilder
{
    private Authentication $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function build(string $method, string $route, ?array $options = []): ResponseInterface
    {
        $client = new HttpClient($this->authentication, new CurlHttpClient());

        return $client->sendRequest($method, $route, $options);
    }
}