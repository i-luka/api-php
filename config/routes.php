<?php

use app\exceptions\NotAuthorizedHttpException;
use Lcobucci\JWT\Token\InvalidTokenStructure;
use Pecee\Http\Request;
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

Router::error(function(Request $request, \Exception $exception) {
    $response = Router::response();
    switch (get_class($exception)) {
        case InvalidTokenStructure::class: {
            $response->auth("api-pure");
            break;
        }
        case NotAuthorizedHttpException::class: {
            $response->httpCode(401);
            $response->auth("api-pure");
            break;
        }
        case Exception::class: {
            $response->httpCode(500);
            break;
        }
    }
    if (PROD) {
        return $response->json([]);
    } else {
        return $response->json([
            'status' => 'error',
            'message' => $exception->getMessage()
        ]);
    }
//    switch($exception->getCode()) {
//        // Page not found
//        case 404:
//            response()->redirect('/not-found');
//        // Forbidden
//        case 403:
//            response()->redirect('/forbidden');
//    }
});

