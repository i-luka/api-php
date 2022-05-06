<?php

namespace app\services;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key;

class AuthenticateService
{
    private Configuration $config;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }
}