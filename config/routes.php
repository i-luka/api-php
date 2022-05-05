<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('app\controllers');

Router::get('/', 'VueController@run');

Router::group([
    'middleware' => [
        \app\middlewares\ProccessRawBody::class
    ]
], function () {
    Router::post('/api/auth/signin', 'AuthController@signin');
    Router::group([
        'middleware' => [
            \app\middlewares\Authenticate::class
        ]
    ], function () {
        Router::post('/api/project', 'AuthController@test');
    });
});

//Router::get('/{controller}/{action?}/{slug?}', 'App@run')
//    ->where(['controller' => '[\w\-]+', 'action' => '[\w\-]+', 'slug' => '[\w\-]+']);

Router::get('/controller', 'VueController@run')
    ->setMatch('/\/([\w]+)/');
