<?php

use Lcobucci\JWT\Token\InvalidTokenStructure;
use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once (__DIR__ . '/../config/routes.php');


try {
    Router::start();
} catch (\app\exceptions\NotAuthorizedHttpException $e) {
    header('WWW-Authenticate: Bearer realm="api-pure"');
    header('HTTP/1.0 401 Unauthorized');
} catch (InvalidTokenStructure $e) {
    header('WWW-Authenticate: Bearer realm="api-pure"');
    header('HTTP/1.0 401 Unauthorized');
    return Router::response()->json([
        'message' => $e->getMessage()
    ]);
}