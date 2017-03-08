<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;
use Exception;

class ExamsGroup extends Controller
{
    public function indexAction($examID)
    {
        $list = new ExamsList($this->get('dbh'));
        $examsList = $list->getExamsByGroupId($examID);

        $one = new ExamsGroupModel($this->get('dbh'));
        $info = $one->getExamsGroupInfoById($examID);

        if (empty($info)) {
            throw new Exception('Exams group does not exist!');
        }

        $this->render('front/list', ['title' => $info->title, 'examsList' => $examsList]);
    }
}
