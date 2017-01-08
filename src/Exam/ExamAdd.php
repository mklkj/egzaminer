<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamAdd extends Controller
{
    public function addAction()
    {
        $this->render('admin-exam-add', [
            'title' => 'Dodawanie testu',
        ]);
    }

    public function postAddAction()
    {
        $model = new ExamAddModel($this->get('dbh'));

        if ($id = $model->add($_POST)) {
            $this->redirectWithMessage('/admin/test/edit/'.$id, 'success', 'Dodano pomyślnie');
        } else {
            $this->redirectWithMessage('/admin/test/add', 'warning', 'Coś się zepsuło');
        }
    }
}
