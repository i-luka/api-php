<?php

namespace app\controllers;

class PortalController
{
    public function run()
    {
        ob_start();
        include '../views/site/main_page.html';
        return ob_get_clean();
    }
}