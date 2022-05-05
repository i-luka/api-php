<?php

namespace app\controllers;

class PortalController extends AbstractController
{
    public function run()
    {
        return $this->renderTemplate('../views/site/main_page.html');
    }
}