<?php

namespace Egzaminer\Admin;

class Logout extends Dashboard
{
    public function logoutAction()
    {
        $this->get('auth')->logout();
        $this->setMessage('success', 'Wylogowano pomyślnie!');
        $this->redirect('/admin/login');
    }
}
