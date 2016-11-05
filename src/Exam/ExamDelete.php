<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamDelete extends Controller
{
    public function deleteAction($id)
    {
        $this->id = $id;
        if (isset($_SESSION['valid'])) {
            $this->data['valid'] = true;
            unset($_SESSION['valid']);
        }

        if (isset($_POST['confirm'])) {
            $delModel = new ExamDeleteModel();

            if ($delModel->delete($id)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin');
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $exam = (new ExamModel())->getInfo($id);
        $this->data['content'] = 'Czy na pewno chcesz usunąć '.$exam['title'].'?';

        $this->render('admin-delete', 'Usuwanie testu');
    }
}
