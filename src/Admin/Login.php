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

        if (isset($_POST['login'])) {
            if (true === $this->get('auth')->login($_POST['username'], $_POST['password'])) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin');
                $this->terminate();
            }
            $this->data['valid'] = false;
        }
        $this->render('login', [
            'title' => 'Logowanie',
        ]);
    }
}
