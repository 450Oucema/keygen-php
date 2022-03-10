<?php

namespace KeygenClient\Service;

use KeygenClient\Contracts\KeygenModel;
use KeygenClient\Http\Request\RequestBuilder;

abstract class AbstractService
{
    protected static array $config = [];
    private RequestBuilder $requestBuilder;

    public static function getRoute(): string
    {
        return static::$config['route'];
    }

    public function __construct(string $keygenAccountId, string $keygenAccountToken)
    {
        $this->requestBuilder = new RequestBuilder($keygenAccountId, $keygenAccountToken);
    }

    public function all($params = []): array
    {
        $route = static::getRoute(). '/?limit=100';

        $response = $this->requestBuilder->build('GET', $route, $params);
        $content = $response->getContent();
        $collection = json_decode($content, true);
        $models = [];

        foreach ($collection['data'] as $data) {
            /** @var KeygenModel $model */
            $model = static::$config['class'];
            $models[] = $model->parse($data);
        }

        return $models;
    }

    public function retrieve(string $id): KeygenModel
    {
        $route = static::getRoute() . '/' . $id;
        $response = $this->requestBuilder->build('GET', $route);
        $content = $response->getContent();
        $data = json_decode($content, true);

        /** @var KeygenModel $model */
        $model = static::$config['class'];

        return $model->parse($data);
    }
}