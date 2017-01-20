<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;
use Egzaminer\Question\Questions;

class ExamEdit extends Controller
{
    public function editAction($examID)
    {
        $exam = (new ExamModel($this->get('dbh')))->getInfo($examID);
        $questions = (new Questions($this->get('dbh')))->getByExamId($examID);

        $this->render('admin-exam-edit', [
            'title'     => 'Edycja testu',
            'exam'      => $exam,
            'questions' => $questions,
        ]);
    }

    public function postEditAction($examID)
    {
        $editModel = new ExamEditModel($this->get('dbh'));

        if ($editModel->edit($examID, $this->getFromRequest('post'))) {
            $this->redirectWithMessage('/admin/exam/edit/'.$examID, 'success', 'Uaktualniono pomyślnie!');
        } else {
            $this->redirectWithMessage('/admin/exam/edit/'.$examID, 'warning', 'Coś się zepsuło!');
        }
    }
}
