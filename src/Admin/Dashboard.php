<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;
use Egzaminer\Roll\ExamsList;

class Dashboard extends Controller
{
    public function __construct($container)
    {
        parent::__construct($container);

        if (!$this->isLogged()) {
            $this->redirect('/admin/login');
            $this->terminate();
        }
    }

    public function indexAction()
    {
        $list = new ExamsList($this->get('dbh'));

        $this->render('dashboard', [
            'title'     => 'Panel zarządzania',
            'examsList' => $list->getList(),
        ]);
    }
}
