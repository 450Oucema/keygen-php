<?php

namespace KeygenClient\Service;

use KeygenClient\Contracts\KeygenModel;
use KeygenClient\Http\Request\RequestBuilder;
use KeygenClient\Model\License;
use KeygenClient\Model\User;
use KeygenClient\Security\Authentication;

abstract class AbstractService
{
    protected string $route;

    private RequestBuilder $requestBuilder;

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getClass(): ?KeygenModel
    {
        switch ($this->route) {
            case License::OBJECT:
                return new License();
            case User::OBJECT:
                return new User();
            default:
                throw new \LogicException("No object is registered for route '{$this->route}'");
        }
    }

    public function __construct(Authentication $authentication)
    {
        $this->requestBuilder = new RequestBuilder($authentication);
    }

    public function all($params = []): array
    {
        $route = $this->getRoute(). '/?limit=100';

        $response = $this->requestBuilder->build('GET', $route, $params);
        $content = $response->getContent();
        $collection = json_decode($content, true);
        $models = [];

        foreach ($collection['data'] as $data) {
            /** @var KeygenModel $model */
            $model = $this->getClass();
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
        $model = $this->getClass();

        return $model->parse($data);
    }
}