<?php

namespace Egzaminer\Admin;

use Egzaminer\Controller;
use Egzaminer\Roll\ExamsList;

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->isLogged()) {
            header('Location: '.$this->dir().'/admin/login');
            exit;
        }
    }

    public function indexAction()
    {
        $list = new ExamsList();

        $this->render('dashboard', [
            'title'     => 'Panel zarządzania',
            'examsList' => $list->getList(),
        ]);
    }
}
