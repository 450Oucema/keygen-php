<?php

namespace KeygenClient\Model;

use KeygenClient\Contracts\KeygenModel;

abstract class AbstractKeygenModel implements KeygenModel
{
    const RELATIONSHIPS_TYPES = [
        'user' => 'users',
        'policy' => 'policies',
        'account' => 'accounts',
        'product' => 'products'
    ];

    protected ?string $id = null;

    protected array $metadata = [];

    private array $relationships = [];

    public function __set(string $key, $value)
    {
        $this->setProperty($key, $value);
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function addMetadata($key, $value)
    {
        $this->metadata[$key] = $value;
    }

    public function getRelationships(): array
    {
        return $this->relationships;
    }

    public function setRelationships(array $relationships): void
    {
        $this->relationships = $relationships;
    }

    public function addRelationship($key, $value)
    {
        $this->relationships[$key] = $value;
    }

    private function setProperty(string $key, $value)
    {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }
    }
}