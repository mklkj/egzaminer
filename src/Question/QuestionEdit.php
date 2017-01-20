<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionEdit extends Controller
{
    public function editAction($examID, $questionID)
    {
        $question = (new Questions($this->get('dbh')))->getByQuestionId($questionID);
        $answers = (new Answers($this->get('dbh')))->getAnswersByOneQuestionId($questionID);

        $this->render('admin-question', [
            'title'        => 'Edycja pytania',
            'id'           => $questionID,
            'examID'       => $examID,
            'question'     => $question,
            'answers'      => $answers,
            'templateType' => 'edit',
        ]);
    }

    public function postEditAction($examID, $questionID)
    {
        $editModel = new QuestionEditModel($this->get('dbh'));

        if ($editModel->edit(
                $questionID,
                $this->getFromRequest('post'),
                $this->getFromRequest('files', 'image'),
                $this->get('rootDir')
            )) {
            $this->setMessage('success', 'Uaktualniono pomyślnie!');
        } else {
            $this->setMessage('warning', 'Coś się zepsuło!');
        }

        $this->redirect('/admin/exam/edit/'.$examID.'/question/edit/'.$questionID);
    }
}
