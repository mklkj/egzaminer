<?php

namespace Egzaminer\Exam;

use Egzaminer\Admin\Dashboard as Controller;

class ExamDelete extends Controller
{
    public function deleteAction($id)
    {
        $exam = (new ExamModel($this->get('dbh')))->getInfo($id);

        $this->render('admin-delete', [
            'title'   => 'Usuwanie testu',
            'content' => 'Czy na pewno chcesz usunąć '.$exam['title'].'?',
        ]);
    }

    public function postDeleteAction($examID)
    {
        $delModel = new ExamDeleteModel($this->get('dbh'));

        if ($delModel->delete($examID)) {
            $this->redirectWithMessage('/admin', 'success', 'Usunięto pomyślnie!');
        } else {
            $this->redirectWithMessage('/admin/test/del/'.$examID, 'warning', 'Coś się zepsuło!');
        }
    }
}
