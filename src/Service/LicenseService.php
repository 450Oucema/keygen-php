<?php

namespace KeygenClient\Service;

use KeygenClient\Model\License;

class LicenseService extends AbstractService
{
    public function __construct(string $keygenAccountId, string $keygenAccountToken)
    {
        parent::__construct($keygenAccountId, $keygenAccountToken);

        static::$config = [
            'route' => 'licenses',
            'class' => new License()
        ];
    }
}