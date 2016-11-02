<?php

namespace Tester\Admin;

use Tester\One\OneTest;
use Tester\One\Questions;
use Tester\One\Answers;

class TestQuestionEdit extends Dashboard
{
    public function editAction($testId, $id)
    {
        $this->testId = $testId;
        if (isset($_SESSION['valid'])) {
            $this->data['valid'] = true;
            unset($_SESSION['valid']);
        }

        if (isset($_POST['submit'])) {
            $editModel = new TestQuestionEditModel();

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId.'/question/edit/'.$id);
                exit;
            } else {
                $this->data['invalid'] = true;
            }
        }

        $question = (new Questions())->getByQuestionId($id);
        $answers = (new Answers())->getAnswersByOneQuestionId($id);

        $this->data['question'] = $question;
        $this->data['answers'] = $answers;

        $this->render('admin-question');
    }
}