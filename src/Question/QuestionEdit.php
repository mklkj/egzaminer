<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionEdit extends Controller
{
    public function editAction($testId, $id)
    {
        $question = (new Questions($this->get('dbh')))->getByQuestionId($id);
        $answers = (new Answers($this->get('dbh')))->getAnswersByOneQuestionId($id);

        $this->render('admin-question', [
            'title'        => 'Edycja pytania',
            'id'           => $id,
            'testId'       => $testId,
            'question'     => $question,
            'answers'      => $answers,
            'templateType' => 'edit',
        ]);
    }

    public function postEditAction($examID, $questionID)
    {
        $editModel = new QuestionEditModel($this->get('dbh'));

        if ($editModel->edit($questionID, $_POST)) {
            $this->redirectWithMessage(
                '/admin/test/edit/'.$examID.'/question/edit/'.$questionID,
                'success',
                'Uaktualniono pomyślnie!'
            );
        } else {
            $this->redirectWithMessage(
                '/admin/test/edit/'.$examID.'/question/edit/'.$questionID,
                'warning',
                'Coś się zepsuło!'
            );
        }
    }
}
