<?php

namespace app\controllers;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class AbstractController
{
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = Router::router()->getRequest();
        $this->response =  new Response($this->request);
    }

    public function renderTemplate($template) {
        ob_start();
        include $template;
        return ob_get_clean();
    }

    public function setCors()
    {
        $this->response->header('Access-Control-Allow-Origin: *');
        $this->response->header('Access-Control-Request-Method: OPTIONS');
        $this->response->header('Access-Control-Allow-Credentials: true');
        $this->response->header('Access-Control-Max-Age: 3600');
    }
}