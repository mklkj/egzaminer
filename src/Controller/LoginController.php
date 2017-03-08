<?php

namespace Egzaminer\Controller;

class LoginController extends AbstractController
{
    /**
     * Login page.
     *
     * GET /admin/login
     *
     * @return void
     */
    public function loginAction()
    {
        if ($this->isLogged()) {
            $this->redirect('/admin');
            $this->terminate();
        }

        $this->render('front/login', ['title' => 'Logowanie']);
    }

    /**
     * Login post action.
     *
     * POST /admin/login
     *
     * @return void
     */
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