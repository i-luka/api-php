<?php

namespace app\controllers;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;

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

    public function test()
    {
//        $headers = getallheaders();
//        $tokenString = substr($headers['Authorization'], 7);
//        $config = Configuration::forSymmetricSigner(
//            new Sha256(),
//            InMemory::plainText('rkjahnvuirfngnqmnfdjs')
//        );
//        $token = $config->parser()->parse($tokenString);
//
////        var_dump(apache_request_headers());
////        var_dump($_SERVER['AUTHORIZATION']);
////        var_dump($constrains);
//        var_dump($config->validator()->validate($token,
//            new SignedWith(new Sha256(),
//                InMemory::plainText('rkjahnvuirfngnqmnfdjs')),
//            new ValidAt(new FrozenClock(new DateTimeImmutable()))
//        ));
//        var_dump($config->validator()->validate($token, new ValidAt(new FrozenClock(new DateTimeImmutable()))));
//        var_dump($this->request->getHeader('AUTHORIZATION'));
    }
}