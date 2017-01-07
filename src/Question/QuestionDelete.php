<?php

namespace Egzaminer\Question;

use Egzaminer\Admin\Dashboard as Controller;

class QuestionDelete extends Controller
{
    public function deleteAction($testId, $id)
    {
        if (isset($_SESSION['valid'])) {
            $this->data['valid'] = true;
            unset($_SESSION['valid']);
        }

        if (isset($_POST['confirm'])) {
            $delModel = new QuestionDeleteModel();

            if ($delModel->delete($id)) {
                $_SESSION['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$testId);
                exit;
            } else {
                $this->data['valid'] = false;
            }
        }

        $question = (new Questions())->getByQuestionId($id);

        $this->render('admin-delete', [
            'title'   => 'Usuwanie pytania',
            'content' => 'Czy na pewno chcesz usunąć pytanie <i>'.$question['content'].'</i>?',
        ]);
    }
}
