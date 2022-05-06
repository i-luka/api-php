<?php

namespace app\controllers;

class ProjectController extends AbstractController
{
    public function index()
    {
        return $this->response->json([
            [
                'name' => 'project 1'
            ]
        ]);
    }
}