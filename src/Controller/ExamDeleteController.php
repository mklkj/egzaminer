<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamDeleteModel;
use Egzaminer\Model\ExamModel;

class ExamDeleteController extends AdminController
{
    /**
     * Delete exam.
     *
     * GET /admin/exam/del/[i:id]
     *
     * @param int $examID
     *
     * @return string
     */
    public function deleteAction(int $examID): string
    {
        $exam = (new ExamModel($this->get('dbh')))->getInfo($examID);

        return $this->render('admin/delete', [
            'title'   => 'Usuwanie testu',
            'content' => 'Czy na pewno chcesz usunąć '.$exam['title'].'?',
        ]);
    }

    /**
     * Delete exam post action.
     *
     * POST /admin/exam/del/[i:id]
     *
     * @param int $examID
     *
     * @return void
     */
    public function postDeleteAction(int $examID)
    {
        $delModel = new ExamDeleteModel($this->get('dbh'));

        if ($delModel->delete($examID)) {
            $this->setMessage('success', 'Usunięto pomyślnie!');
            $this->redirect('/admin');

            return;
        }

        $this->setMessage('warning', 'Coś się zepsuło!');
        $this->redirect('/admin/exam/del/'.$examID);
    }
}
