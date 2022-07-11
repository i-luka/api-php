<?php

use app\exceptions\{
    NotAuthorizedHttpException
};
use app\middlewares\{
    Authenticate,
    ProccessRawBody
};
use Pecee\{
    Http\Request,
    SimpleRouter\SimpleRouter as Router
};

const PROD = false;

Router::setDefaultNamespace('app\controllers');

Router::get('/', 'VueController@run');

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        ProccessRawBody::class
    ]
], function () {
    Router::post('/auth/sign-in', 'AuthController@signin');
    Router::get('/project', 'ProjectController@index');
    Router::group([
        'middleware' => [
            Authenticate::class
        ]
    ], function () {
        // authenticated routes
        Router::post('/project/create', 'ProjectController@create');
        Router::post('/project/update/{id}', 'ProjectController@update')
            ->where(['id' => '[\d]+']);
    });
});

Router::get('/controller', 'VueController@run')
    ->setMatch('/\/([\w]+)/');

Router::error(function(Request $request, Exception $exception) {
    $response = Router::response();
    switch (get_class($exception)) {
        case NotAuthorizedHttpException::class: {
            $response->httpCode(401);
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
});

