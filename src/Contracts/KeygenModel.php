<?php

namespace KeygenClient\Contracts;

interface KeygenModel
{
    public function parse(array $data): self;
    public function toJson(): string;
}