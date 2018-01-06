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
     * @return string
     */
    public function indexAction(): string
    {
        $list = new ExamsListModel($this->get('dbh'));

        return $this->render('admin/index', [
            'title'     => 'Panel zarządzania',
            'examsList' => $list->getList(),
        ]);
    }
}
