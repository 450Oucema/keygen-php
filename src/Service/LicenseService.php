<?php

namespace KeygenClient\Service;

use KeygenClient\Model\License;
use KeygenClient\Security\Authentication;

class LicenseService extends AbstractService
{
    public function __construct(Authentication $authentication)
    {
        parent::__construct($authentication);
        $this->route = License::OBJECT;
    }
}