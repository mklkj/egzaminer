<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionDelete extends Controller
{
    public function deleteAction($examID, $questionID)
    {
        $question = (new Questions($this->get('dbh')))->getByQuestionId($questionID);

        $this->render('admin-delete', [
            'title'   => 'Usuwanie pytania',
            'content' => 'Czy na pewno chcesz usunąć pytanie <i>'.$question['content'].'</i>?',
        ]);
    }

    public function postDeleteAction($examID, $questionID)
    {
        $delModel = new QuestionDeleteModel($this->get('dbh'));

        if ($delModel->delete($questionID)) {
            $this->setMessage('success', 'Usunięto pomyślnie!');
            $this->redirect('/admin/exam/edit/'.$examID);

            return;
        }

        $this->setMessage('warning', 'Coś się zepsuło!');
        $this->redirect('/admin/exam/edit/'.$examID.'/question/del/'.$questionID);
    }
}
