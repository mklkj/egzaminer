<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;

class Dashboard extends Controller
{
    protected function init()
    {
        if (!$this->isLogged()) {
            header('Location: '.$this->dir().'/admin/login');
            exit;
        }
    }

    public function indexAction()
    {
        $this->render('dashboard', 'Panel zarządzania');
    }
}
