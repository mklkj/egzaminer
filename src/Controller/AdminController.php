<?php

namespace Egzaminer\Controller;

abstract class AdminController extends AbstractController
{
    /**
     * Constructor.
     *
     * @param array $container
     */
    public function __construct($container)
    {
        parent::__construct($container);

        if (!$this->isLogged()) {
            $this->redirect('/admin/login');
            $this->terminate();
        }
    }
}
