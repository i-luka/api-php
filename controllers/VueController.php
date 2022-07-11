<?php

namespace app\controllers;

class VueController extends AbstractController
{
    public function run()
    {
        return $this->renderTemplate('../views/vue/vue_page.php');
    }
}