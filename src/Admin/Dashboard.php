<?php

namespace Tester\Admin;

use Tester\AbstractController;

class Dashboard extends AbstractController
{
    protected function init()
    {
        $auth = new Auth();
        if (!$auth->isLogged()) {
            header('Location: '.$this->dir().'/admin/login');
            exit;
        }
    }

    public function indexAction()
    {
        $this->render('dashboard');
    }
}
