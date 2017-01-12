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
            $this->redirectWithMessage(
                '/admin/exam/edit/'.$examID,
                'success',
                'Usunięto pomyślnie!'
            );
        } else {
            $this->redirectWithMessage(
                '/admin/exam/edit/'.$examID.'/question/del/'.$questionID,
                'warning',
                'Coś się zepsuło!'
            );
        }
    }
}
