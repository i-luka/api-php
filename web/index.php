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

define('PROD', true);

Router::start();