<?php

namespace app\controllers;

class VueController
{
    public function run()
    {
        ob_start();
        include '../views/vue/vue_page.html';
        return ob_get_clean();
    }
}