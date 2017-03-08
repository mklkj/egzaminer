<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\QuestionDeleteModel;
use Egzaminer\Model\QuestionsModel;

class QuestionDeleteController extends AdminController
{
    /**
     * Delete question.
     *
     * GET /admin/exam/edit/[i:id]/question/del/[i:qid]
     *
     * @param int $examID
     * @param int $questionID
     *
     * @return void
     */
    public function deleteAction($examID, $questionID)
    {
        $question = (new QuestionsModel($this->get('dbh')))->getByQuestionId($questionID);

        $this->render('admin/delete', [
            'title'   => 'Usuwanie pytania',
            'content' => 'Czy na pewno chcesz usunąć pytanie <i>'.$question['content'].'</i>?',
        ]);
    }

    /**
     * Delete question post action.
     *
     * POST /admin/exam/edit/[i:id]/question/del/[i:qid]
     *
     * @param int $examID
     * @param int $questionID
     *
     * @return void
     */
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
