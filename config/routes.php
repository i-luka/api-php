<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

/** @var $container \DI\Container */

Router::setDefaultNamespace('app\controllers');



Router::get('/', 'VueController@run');

Router::group([
    'prefix' => 'api'
], function () {
    Router::group([
        'middleware' => [
            \app\middlewares\ProccessRawBody::class
        ]
    ], function () {
        Router::post('/auth/signin', 'AuthController@signin');
        Router::get('/project', 'ProjectController@index');
        Router::group([
            'middleware' => [
                \app\middlewares\Authenticate::class
            ]
        ], function () {
            // authenticated routes
            Router::get('/project/create', 'ProjectController@index');
        });
    });
});

//Router::get('/{controller}/{action?}/{slug?}', 'App@run')
//    ->where(['controller' => '[\w\-]+', 'action' => '[\w\-]+', 'slug' => '[\w\-]+']);

Router::get('/controller', 'VueController@run')
    ->setMatch('/\/([\w]+)/');

