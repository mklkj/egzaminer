<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionEdit extends Controller
{
    public function editAction($testId, $id)
    {
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

        $question = (new Questions())->getByQuestionId($id);
        $answers = (new Answers())->getAnswersByOneQuestionId($id);

        $this->render('admin-question', [
            'title' => 'Edycja pytania',
            'id' => $id,
            'testId' => $testId,
            'question' => $question,
            'answers' => $answers,
            'templateType' => 'edit',
        ]);
    }
}
