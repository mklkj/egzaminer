<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;
use Egzaminer\Roll\ExamsGroupModel;

class ExamAdd extends Controller
{
    public function addAction()
    {
        if (isset($_POST['add'])) {
            $model = new ExamAddModel();
            if ($id = $model->add($_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $this->data['exams_groups'] = (new ExamsGroupModel())->getExamsGroups();

        $this->render('admin-exam-add', 'Dodawanie testu');
    }
}
