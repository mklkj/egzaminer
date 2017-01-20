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

        if ($id = $model->add($this->getFromRequest('post'))) {
            $this->redirectWithMessage('/admin/exam/edit/'.$id, 'success', 'Dodano pomyślnie');
        }

        $this->redirectWithMessage('/admin/exam/add', 'warning', 'Coś się zepsuło');
    }
}
