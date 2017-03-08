<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamAdd extends Controller
{
    public function addAction()
    {
        $this->render('admin/exam/add', [
            'title' => 'Dodawanie testu',
        ]);
    }

    public function postAddAction()
    {
        $model = new ExamAddModel($this->get('dbh'));

        if ($id = $model->add($this->getFromRequest('post'))) {
            $this->setMessage('success', 'Dodano pomyślnie');
            $this->redirect('/admin/exam/edit/'.$id);

            return;
        }

        $this->setMessage('warning', 'Coś się zepsuło');
        $this->redirect('/admin/exam/add');
    }
}
