<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamsListModel;

class DashboardController extends AdminController
{
    /**
     * Dashboard admin page.
     *
     * GET /admin
     *
     * @return void
     */
    public function indexAction()
    {
        $list = new ExamsListModel($this->get('dbh'));

        $this->render('admin/index', [
            'title'     => 'Panel zarządzania',
            'examsList' => $list->getList(),
        ]);
    }
}
