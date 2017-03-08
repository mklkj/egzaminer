<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\AnswersModel;
use Egzaminer\Model\QuestionEditModel;
use Egzaminer\Model\QuestionsModel;

class QuestionEditController extends AdminController
{
    /**
     * Edit question.
     *
     * GET /admin/exam/edit/[i:id]/question/edit/[i:qid]
     *
     * @param int $examID     Exam id
     * @param int $questionID Question ID
     *
     * @return void
     */
    public function editAction($examID, $questionID)
    {
        $question = (new QuestionsModel($this->get('dbh')))->getByQuestionId($questionID);
        $answers = (new AnswersModel($this->get('dbh')))->getAnswersByOneQuestionId($questionID);

        $this->render('admin/question', [
            'title'        => 'Edycja pytania',
            'id'           => $questionID,
            'examID'       => $examID,
            'question'     => $question,
            'answers'      => $answers,
            'templateType' => 'edit',
        ]);
    }

    /**
     * Edit question post action.
     *
     * POST /admin/exam/edit/[i:id]/question/edit/[i:qid]
     *
     * @param int $examID     Exam id
     * @param int $questionID Question ID
     *
     * @return void
     */
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
