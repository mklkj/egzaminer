<?php

namespace Egzaminer\Admin;

class TestQuestionAdd extends Dashboard
{
    public function addAction($testId)
    {
        $this->testId = $testId;
        $this->data = [
            'question' => [
                'content' => '',
                'correct' => '',
            ],
            'answers' => [ // lol
                ['content' => '', 'id' => ''],
                ['content' => '', 'id' => ''],
                ['content' => '', 'id' => ''],
                ['content' => '', 'id' => ''],
            ],
        ];
        if (isset($_POST['submit'])) {
            $model = new TestQuestionAddModel();
            if ($id = $model->add($testId, $_POST)) {
                $this->data['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId.'/question/edit/'.$id);
                exit;
            } else {
                $this->data['invalid'] = true;
            }
        }
        $this->render('admin-question');
    }
}
