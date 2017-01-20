<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;

class Login extends Controller
{
    public function loginAction()
    {
        if ($this->get('auth')->isLogged()) {
            header('Location: '.$this->dir().'/admin');
            $this->terminate();
        }

        $this->render('login', [
            'title' => 'Logowanie',
        ]);
    }

    public function postLoginAction()
    {
        if (true === $this->get('auth')->login(
                $this->getFromRequest('post', 'username'),
                $this->getFromRequest('post', 'password')
            )) {
            $this->redirectWithMessage('/admin', 'success', 'Zalogowano pomyślnie!');
        }

        $this->redirectWithMessage('/admin/login', 'warning', 'Złe hasło!');
    }
}
