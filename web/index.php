<?php

use app\controllers\VueController;
use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../vendor/autoload.php';
//require_once (__DIR__ . '/../config/routes.php');

//try {
//    Router::start();
//} catch (Throwable $e) {
//
//}

$route = new \app\engine\Route();
$route->setDefaultNamespace('app\controllers');
$route->get('/', [VueController::class, 'run']);
$route->get('/controller', [VueController::class, 'run'])
    ->setMatch('/\/([\w]+)/');

$route->start();