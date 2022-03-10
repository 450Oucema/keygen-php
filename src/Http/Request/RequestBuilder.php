<?php

namespace KeygenClient\Http\Request;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RequestBuilder
{
    private HttpClientInterface $client;

    public function __construct(string $keygenAccountId, string $keygenAccountToken)
    {
        $this->client = HttpClient::create([
            'auth_bearer' => $keygenAccountToken,
            'base_uri' => "https://api.keygen.sh/v1/accounts/{$keygenAccountId}/"
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function build(string $method, string $route, ?array $options = []): ResponseInterface
    {
        return $this->client->request($method, $route, $options);
    }
}