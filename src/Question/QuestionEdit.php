<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionEdit extends Controller
{
    public function editAction($testId, $id)
    {
        $this->testId = $testId;
        $this->id = $id;

        $question = (new Questions())->getByQuestionId($id);

        if (isset($_POST['submit'])) {
            $editModel = new QuestionEditModel();

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId
                    .'/question/edit/'.$id);

                exit;
            } else {
                $this->data['valid'] = false;
            }
        }
        $answers = (new Answers())->getAnswersByOneQuestionId($id);

        $this->data['question'] = $question;
        $this->data['answers'] = $answers;
        $this->templateType = 'edit';

        $this->render('admin-question', 'Edycja pytania');
    }
}
