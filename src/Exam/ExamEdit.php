<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;
use Egzaminer\Question\Questions;

class ExamEdit extends Controller
{
    public function editAction($id)
    {
        if (isset($_SESSION['valid'])) {
            $this->data['valid'] = true;
            unset($_SESSION['valid']);
        }

        if (isset($_POST['edit'])) {
            $editModel = new ExamEditModel($this->get('dbh'));

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $exam = (new ExamModel($this->get('dbh')))->getInfo($id);
        $questions = (new Questions($this->get('dbh')))->getByExamId($id);

        $this->render('admin-exam-edit', [
            'title'     => 'Edycja testu',
            'exam'      => $exam,
            'questions' => $questions,
        ]);
    }
}
