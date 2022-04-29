<?php

namespace app\controllers;

class App
{
    public function run(...$args)
    {
        var_dump($args);
        list($controller, $action, $parameter) = $args;
        $class = '\\app\\controllers\\' .ucfirst($controller) . 'Controller';
        $c = new $class;
        $c->$action;
    }
}