<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamEditModel;
use Egzaminer\Model\ExamModel;
use Egzaminer\Model\QuestionsModel;
use Egzaminer\Question\Questions;

class ExamEditController extends AdminController
{
    /**
     * Edit exam action.
     *
     * GET /admin/exam/edit/[i:id]
     *
     * @return string
     */
    public function editAction($examID)
    {
        $exam = (new ExamModel($this->get('dbh')))->getInfo($examID);
        $questions = (new QuestionsModel($this->get('dbh')))->getByExamId($examID);

        return $this->render('admin/exam/edit', [
            'title'     => 'Edycja testu',
            'exam'      => $exam,
            'questions' => $questions,
        ]);
    }

    /**
     * Edit exam post action.
     *
     * POST /admin/exam/edit/[i:id]
     *
     * @return void
     */
    public function postEditAction($examID)
    {
        $editModel = new ExamEditModel($this->get('dbh'));

        if ($editModel->edit($examID, $this->getFromRequest('post'))) {
            $this->setMessage('success', 'Uaktualniono pomyślnie!');
        } else {
            $this->setMessage('warning', 'Coś się zepsuło!');
        }

        $this->redirect('/admin/exam/edit/'.$examID);
    }
}
