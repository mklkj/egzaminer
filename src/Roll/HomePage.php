<?php

namespace Tester\Roll;

use Tester\AbstractController;

class HomePage extends AbstractController
{
    public function indexAction()
    {
        // access on all pages - in AbstractController

        // $list = new TestsList();
        // $this->data['tests_list'] = $list->getList();

        $this->render('list');
    }
}
