<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamsGroupModel;
use Egzaminer\Model\ExamsListModel;
use Exception;

class ExamsGroupController extends AbstractController
{
    /**
     * Exams group index action.
     *
     * GET /group/[i:id]
     *
     * @param int $examID Exam ID
     *
     * @return void
     */
    public function indexAction($examID)
    {
        $list = new ExamsListModel($this->get('dbh'));
        $examsList = $list->getExamsByGroupId($examID);

        $one = new ExamsGroupModel($this->get('dbh'));
        $info = $one->getExamsGroupInfoById($examID);

        if (empty($info)) {
            throw new Exception('Exams group does not exist!');
        }

        $this->render('front/list', ['title' => $info->title, 'examsList' => $examsList]);
    }
}
