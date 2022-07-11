<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once (__DIR__ . '/../config/routes.php');

try {
    Router::start();
} catch (Throwable $e) {

}