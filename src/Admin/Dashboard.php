<?php

namespace Egzaminer\Admin;

use Egzaminer\Roll\ExamsList;
use Egzaminer\Controller;

class Dashboard extends Controller
{
    protected function init()
    {
        if (!$this->isLogged()) {
            header('Location: '.$this->dir().'/admin/login');
            exit;
        }
    }

    public function indexAction()
    {
        $list = new ExamsList();
        $this->data['exams_list'] = $list->getList();

        $this->render('dashboard', 'Panel zarządzania');
    }
}
