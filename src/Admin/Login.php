<?php

namespace Tester\Admin;

use Tester\AbstractController;

class Login extends AbstractController
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
        $this->render('login');
    }
}
