<?php

namespace Egzaminer\Admin;

class Logout extends Dashboard
{
    public function logoutAction()
    {
        $this->get('auth')->logout();
        $this->redirectWithMessage('/admin/login', 'success', 'Wylogowano pomyślnie');
    }
}
