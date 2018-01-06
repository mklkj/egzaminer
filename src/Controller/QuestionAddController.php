<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\QuestionAddModel;

class QuestionAddController extends AdminController
{
    /**
     * Add question.
     *
     * GET /admin/exam/edit/[i:tid]/question/add
     *
     * @param int $examID Exam id
     *
     * @return string
     */
    public function addAction(int $examID): string
    {
        $question = [
            'content' => '',
            'correct' => '',
            'image'   => '',
        ];
        $answers = [
            ['content' => '', 'id' => '1'],
            ['content' => '', 'id' => '2'],
            ['content' => '', 'id' => '3'],
            ['content' => '', 'id' => '4'],
        ];

        return $this->render('admin/question', [
            'title'    => 'Dodawanie pytania',
            'examID'   => $examID,
            'question' => $question,
            'answers'  => $answers,
        ]);
    }

    /**
     * Add question post action.
     *
     * POST /admin/exam/edit/[i:tid]/question/add
     *
     * @param int $examID Exam id
     *
     * @return void
     */
    public function postAddAction(int $examID)
    {
        $model = new QuestionAddModel($this->get('dbh'));

        if ($id = $model->add($examID, $this->getFromRequest('post'))) {
            $this->setMessage('success', 'Dodano pomyślnie!');
            $this->redirect('/admin/exam/edit/'.$examID.'/question/edit/'.$id);

            return;
        }

        $this->setMessage('warning', 'Coś się zepsuło!');
        $this->redirect('/admin/exam/edit/'.$examID.'/question/add');
    }
}
