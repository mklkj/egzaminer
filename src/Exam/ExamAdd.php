<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamAdd extends Controller
{
    public function addAction()
    {
        if (isset($_POST['add'])) {
            $model = new ExamAddModel();
            if ($id = $model->add($_POST)) {
                $this->data['test-add']['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['test-add']['invalid'] = true;
            }
        }
        $this->render('admin-test-add');
    }
}
