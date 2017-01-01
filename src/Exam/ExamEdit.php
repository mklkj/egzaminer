<?php

namespace Egzaminer\Exam;

use Egzaminer\Question\Questions;
use Egzaminer\Question\Answers;
use Egzaminer\Admin\Dashboard as Controller;
use Egzaminer\Roll\ExamsGroupModel;

class ExamEdit extends Controller
{
    public function editAction($id)
    {
        if (isset($_SESSION['valid'])) {
            $this->data['valid'] = true;
            unset($_SESSION['valid']);
        }

        if (isset($_POST['edit'])) {
            $editModel = new ExamEditModel();

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $exam = (new ExamModel())->getInfo($id);
        $questions = (new Questions())->getByExamId($id);

        $this->render('admin-exam-edit', [
            'title' => 'Edycja testu',
            'exam' => $exam,
            'questions' => $questions,
        ]);
    }
}
