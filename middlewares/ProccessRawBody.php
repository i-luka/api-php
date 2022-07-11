<?php

namespace app\middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class ProccessRawBody implements IMiddleware
{

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        $rawBody = file_get_contents('php://input');

        if ($rawBody) {
            try {
             $body = json_decode($rawBody, true);
             foreach ($body as $key => $value) {
                 $request->$key = $value;
             }
            } catch (\Throwable $e) {

            }
        }
    }
}