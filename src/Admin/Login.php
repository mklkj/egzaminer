<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;

class Login extends Controller
{
    public function loginAction()
    {
        $auth = new Auth();
        if ($auth->isLogged()) {
            header('Location: '.$this->dir().'/admin');
            exit;
        }

        if (isset($_POST['login'])) {
            if (true === $auth->login($_POST['username'], $_POST['password'])) {
                header('Location: '.$this->dir().'/admin');
                exit;
            }
            $this->data['form']['invalid'] = true;
        }
        $this->render('login', 'Logowanie');
    }
}
