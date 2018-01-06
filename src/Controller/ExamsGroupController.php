<?php

namespace Egzaminer\Controller;

use Egzaminer\Model\ExamsGroupModel;
use Egzaminer\Model\ExamsListModel;
use Exception;
use RuntimeException;

class ExamsGroupController extends AbstractController
{
    /**
     * Exams group index action.
     * GET /group/[i:id].
     *
     * @param int $examID Exam ID
     *
     * @throws Exception
     *
     * @return string
     */
    public function indexAction(int $examID): string
    {
        $list = new ExamsListModel($this->get('dbh'));
        $examsList = $list->getExamsByGroupId($examID);

        $one = new ExamsGroupModel($this->get('dbh'));
        $info = $one->getExamsGroupInfoById($examID);

        if (null === $info) {
            throw new RuntimeException('Exams group does not exist!');
        }

        return $this->render('front/list', ['title' => $info->title, 'examsList' => $examsList]);
    }
}
