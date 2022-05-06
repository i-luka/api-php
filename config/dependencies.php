<?php

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;

return [
    'jwt.secret.key' => 'rkjahnvuirfngnqmnfdjs',
    'jwt.signer'     => new \Lcobucci\JWT\Signer\Hmac\Sha256(),
    Configuration::class     => function ( \Psr\Container\ContainerInterface $c) {
                            return Lcobucci\JWT\Configuration::forSymmetricSigner(
                                $c->get('jwt.signer'),
                                InMemory::plainText($c->get('jwt.secret.key'))
                            );
                        }
];
