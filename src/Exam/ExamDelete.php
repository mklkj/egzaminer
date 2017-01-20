<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamDelete extends Controller
{
    public function deleteAction($examID)
    {
        $exam = (new ExamModel($this->get('dbh')))->getInfo($examID);

        $this->render('admin-delete', [
            'title'   => 'Usuwanie testu',
            'content' => 'Czy na pewno chcesz usunąć '.$exam['title'].'?',
        ]);
    }

    public function postDeleteAction($examID)
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
