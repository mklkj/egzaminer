<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;

class Login extends Controller
{
    public function loginAction()
    {
        if ($this->get('auth')->isLogged()) {
            header('Location: '.$this->dir().'/admin');
            exit;
        }

        if (isset($_POST['login'])) {
            if (true === $this->get('auth')->login($_POST['username'], $_POST['password'])) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin');
                exit;
            }
            $this->data['valid'] = false;
        }
        $this->render('login', [
            'title' => 'Logowanie',
        ]);
    }
}
