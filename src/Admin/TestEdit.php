<?php

namespace Tester\Admin;

use Tester\One\OneTest;
use Tester\One\Questions;
use Tester\One\Answers;

class TestEdit extends Dashboard
{
    public function editAction($id)
    {
        if (isset($_SESSION['test-edit-valid'])) {
            $this->data['test-edit']['valid'] = true;
            unset($_SESSION['test-edit-valid']);
        }

        if (isset($_POST['edit'])) {
            $editModel = new TestEditModel();

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['test-edit-valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['test-edit']['invalid'] = true;
            }
        }

        $oneTest = (new OneTest())->getInfo($id);
        $questions = (new Questions())->getByTestId($id);
        $answers = (new Answers())->getAnswersByQuestions($questions);

        $this->data['test-edit']['test'] = $oneTest;
        $this->data['test-edit']['questions'] = $questions;
        $this->data['test-edit']['answers'] = $answers;

        $this->render('admin-test-edit');
    }
}
