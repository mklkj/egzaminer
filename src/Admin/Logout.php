<?php

namespace Egzaminer\Admin;

class Logout extends Dashboard
{
    public function logoutAction()
    {
        $this->auth->logout();
        header('Location: '.$this->dir().'/admin/login');
        exit;
    }
}
