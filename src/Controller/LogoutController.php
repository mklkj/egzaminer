<?php

namespace Egzaminer\Controller;

class LogoutController extends AdminController
{
    /**
     * User logout.
     *
     * GET /admin/logout
     *
     * @return void
     */
    public function logoutAction()
    {
        $this->get('auth')->logout();
        $this->setMessage('success', 'Wylogowano pomyślnie!');
        $this->redirect('/admin/login');
    }
}
