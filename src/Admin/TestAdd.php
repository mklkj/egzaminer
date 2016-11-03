<?php

namespace Egzaminer\Admin;

class TestAdd extends Dashboard
{
    public function addAction()
    {
        if (isset($_POST['add'])) {
            $model = new TestAddModel();
            if ($id = $model->add($_POST)) {
                $this->data['test-add']['valid'] = true;
                header('Location: '.$this->dir().'/admin/test/edit/'.$id);
                exit;
            } else {
                $this->data['test-add']['invalid'] = true;
            }
        }
        $this->render('admin-test-add');
    }
}
