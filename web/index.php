<?php

use Lcobucci\JWT\Token\InvalidTokenStructure;
use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once (__DIR__ . '/../config/routes.php');
$dependencies = require (__DIR__ . '/../config/dependencies.php');

//$container = new \DI\Container();
$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->addDefinitions($dependencies);
$container = $builder->build();

define('PROD', false);
try {
    Router::start();
} catch (\app\exceptions\NotAuthorizedHttpException $e) {
    $response = Router::response();
    $response->httpCode(401);
    $response->auth("api-pure");
} catch (InvalidTokenStructure $e) {
    $response = Router::response();
    $response->auth("api-pure");
    return $response->json([
        'message' => $e->getMessage()
    ]);
} catch (Error $e) {
    $response = Router::response();
    $response->httpCode(500);
    if (!PROD) {
        return $response->json([
            'status' => 'error',
            'code' => 500,
            'message' => $e->getMessage()
        ]);
    }
}