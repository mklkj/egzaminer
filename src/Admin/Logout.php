<?php

namespace Egzaminer\Admin;

class Logout extends Dashboard
{
    public function logoutAction()
    {
        $this->get('auth')->logout();
        header('Location: '.$this->dir().'/admin/login');
        exit;
    }
}
