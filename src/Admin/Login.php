<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;

class Login extends Controller
{
    public function loginAction()
    {
        if ($this->isLogged()) {
            $this->redirect('/admin');
            $this->terminate();
        }

        $this->render('login', ['title' => 'Logowanie']);
    }

    public function postLoginAction()
    {
        if (true === $this->get('auth')->login(
                $this->getFromRequest('post', 'username'),
                $this->getFromRequest('post', 'password')
            )) {
            $this->setMessage('success', 'Zalogowano pomyślnie!');
            $this->redirect('/admin');

            return;
        }

        $this->setMessage('warning', 'Złe hasło!');
        $this->redirect('/admin/login');
    }
}
