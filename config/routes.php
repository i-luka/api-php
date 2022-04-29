<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::setDefaultNamespace('app\controllers');

Router::get('/', 'VueController@run');


Router::get('/{controller}/{action?}/{slug?}', 'App@run')
    ->where(['controller' => '[\w\-]+', 'action' => '[\w\-]+', 'slug' => '[\w\-]+']);

Router::get('/controller', 'VueController@run')
    ->setMatch('/\/([\w]+)/');
