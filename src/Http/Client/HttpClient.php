<?php

namespace KeygenClient\Http\Client;

use KeygenClient\Security\Authentication;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClient
{
    /**
     * First param : Account ID
     * Second param: Api route
     */
    public const REQUEST_BASE_URI = 'https://api.keygen.sh/v1/accounts/%s/%s';

    protected HttpClientInterface $httpClient;
    protected Authentication $authentication;

    public function __construct(Authentication $authentication, HttpClientInterface $httpClient)
    {
        $this->authentication = $authentication;
        $this->httpClient = $httpClient;
    }

    public function sendRequest(string $method, string $route, ?array $options = []): ResponseInterface
    {
        $uri = sprintf(self::REQUEST_BASE_URI, $this->authentication->getAccountId(), $route);
        $options['auth_bearer'] = $this->authentication->getAccessToken();

        $response = $this->httpClient->request($method, $uri, $options);

        return $response;
    }
}