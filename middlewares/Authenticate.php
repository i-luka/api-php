<?php

namespace app\middlewares;

use app\exceptions\NotAuthorizedHttpException;
use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Authenticate implements IMiddleware
{

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        $headers = getallheaders();
        $tokenString = substr($headers['Authorization'] ?? '', 7);
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('rkjahnvuirfngnqmnfdjs')
        );

        $token = $config->parser()->parse($tokenString);

        if (
            !$config->validator()->validate(
                $token,
                new SignedWith(
                    new Sha256(),
                    InMemory::plainText('rkjahnvuirfngnqmnfdjs')
                ),
                new ValidAt(new FrozenClock(new DateTimeImmutable()))
            )
        ) {
            throw new NotAuthorizedHttpException('Токен доступа не валиден или просрочен');
        }

        $userId = $token->claims()->get('uid');
        $request['uid'] = $userId;
    }
}