<?php

namespace Egzaminer\Controller;

abstract class AdminController extends AbstractController
{
    public function __construct(array $container)
    {
        parent::__construct($container);

        if (!$this->isLogged()) {
            $this->redirect('/admin/login');
            $this->terminate();
        }
    }
}
