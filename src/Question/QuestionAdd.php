<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionAdd extends Controller
{
    public function addAction($testId)
    {
        $question = [
            'content' => '',
            'correct' => '',
            'image' => '',
        ];
        $answers = [
                ['content' => '', 'id' => '1'],
                ['content' => '', 'id' => '2'],
                ['content' => '', 'id' => '3'],
                ['content' => '', 'id' => '4'],
        ];

        if (isset($_POST['submit'])) {
            $model = new QuestionAddModel();

            if ($id = $model->add($testId, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId.'/question/edit/'.$id);
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $this->render('admin-question', [
            'title' => 'Dodawanie pytania',
            'testId' => $testId,
            'question' => $question,
            'answers' => $answers,
        ]);
    }
}
