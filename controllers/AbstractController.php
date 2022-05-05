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
        $this->response =  new \Pecee\Http\Response($this->request);
//        $rawBody = file_get_contents('php://input');
//        if ($rawBody) {
//            try {
//                $body = json_decode($rawBody, true);
//                foreach ($body as $key => $value) {
//                    $this->request->$key = $value;
//                }
//            } catch (\Throwable $e) {
//
//            }
//        }
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