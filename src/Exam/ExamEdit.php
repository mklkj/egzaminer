<?php

namespace Egzaminer\Exam;

use Egzaminer\Question\Questions;
use Egzaminer\Question\Answers;
use Egzaminer\Admin\Dashboard as Controller;

class ExamEdit extends Controller
{
    public function editAction($id)
    {
        if (isset($_SESSION['test-edit-valid'])) {
            $this->data['test-edit']['valid'] = true;
            unset($_SESSION['test-edit-valid']);
        }

        if (isset($_POST['edit'])) {
            $editModel = new ExamEditModel();

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['test-edit-valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['test-edit']['invalid'] = true;
            }
        }

        $exam = (new ExamModel())->getInfo($id);
        $questions = (new Questions())->getByExamId($id);
        $answers = (new Answers())->getAnswersByQuestions($questions);

        $this->data['test-edit']['test'] = $exam;
        $this->data['test-edit']['questions'] = $questions;
        // $this->data['test-edit']['answers'] = $answers;

        $this->render('admin-test-edit');
    }
}
