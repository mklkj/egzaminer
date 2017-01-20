<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionAdd extends Controller
{
    public function addAction($examID)
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

        $this->render('admin-question', [
            'title'    => 'Dodawanie pytania',
            'examID'   => $examID,
            'question' => $question,
            'answers'  => $answers,
        ]);
    }

    public function postAddAction($examID)
    {
        $model = new QuestionAddModel($this->get('dbh'));

        if ($id = $model->add($examID, $this->getFromRequest('post'))) {
            $this->redirectWithMessage(
                '/admin/exam/edit/'.$examID.'/question/edit/'.$id,
                'success',
                'Dodano pomyślnie!'
            );
        } else {
            $this->redirectWithMessage(
                '/admin/exam/edit/'.$examID.'/question/add',
                'warning',
                'Coś się zepsuło!'
            );
        }
    }
}
