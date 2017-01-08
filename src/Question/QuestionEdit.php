<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionEdit extends Controller
{
    public function editAction($testId, $id)
    {
        if (isset($_POST['submit'])) {
            $editModel = new QuestionEditModel($this->get('dbh'));

            if ($editModel->edit($id, $_POST)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId.'/question/edit/'.$id);
                $this->terminate();
            } else {
                $this->data['valid'] = false;
            }
        }

        $question = (new Questions($this->get('dbh')))->getByQuestionId($id);
        $answers = (new Answers($this->get('dbh')))->getAnswersByOneQuestionId($id);

        $this->render('admin-question', [
            'title'        => 'Edycja pytania',
            'id'           => $id,
            'testId'       => $testId,
            'question'     => $question,
            'answers'      => $answers,
            'templateType' => 'edit',
        ]);
    }
}
