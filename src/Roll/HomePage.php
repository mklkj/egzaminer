<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;

class HomePage extends Controller
{
    public function indexAction()
    {
        $model = new ExamsGroupModel();
        $this->data['groups'] = $model->getExamsGroups();

        $this->render('homepage', 'Testy');
    }
}
