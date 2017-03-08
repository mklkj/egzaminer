<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamAddModel;

class ExamAddController extends AbstractController
{
    /**
     * Add exam.
     *
     * GET /admin/exam/add
     *
     * @return void
     */
    public function addAction()
    {
        $this->render('admin/exam/add', [
            'title' => 'Dodawanie testu',
        ]);
    }

    /**
     * Add exam post action.
     *
     * POST /admin/exam/add
     *
     * @return void
     */
    public function postAddAction()
    {
        $model = new ExamAddModel($this->get('dbh'));

        if ($id = $model->add($this->getFromRequest('post'))) {
            $this->setMessage('success', 'Dodano pomyślnie');
            $this->redirect('/admin/exam/edit/'.$id);

            return;
        }

        $this->setMessage('warning', 'Coś się zepsuło');
        $this->redirect('/admin/exam/add');
    }
}
