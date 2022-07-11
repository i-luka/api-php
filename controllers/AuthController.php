<?php

namespace app\controllers;

use app\models\Request;
use ArgumentCountError;
use DateTimeImmutable;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;

class AuthController extends AbstractController
{
    public function signin()
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('rkjahnvuirfngnqmnfdjs')
        );
        $now   = new DateTimeImmutable();
        $token = $config->builder()
            // Configures the issuer (iss claim)
            ->issuedBy('http://example.com')
            // Configures the audience (aud claim)
            ->permittedFor('http://example.org')
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+2 minutes'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ->getToken($config->signer(), $config->signingKey());
        
        return $this->response->json([
            'accessToken' => $token->toString()
        ]);
    }
}