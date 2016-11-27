<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;
use Exception;

class ExamsGroup extends Controller
{
    public function indexAction($examId)
    {
        $list = new ExamsList();
        $this->data['exams_list'] = $list->getExamsByGroupId($examId);

        $one = new ExamsGroupModel();
        $info = $one->getExamsGroupInfoById($examId);

        if (empty($info)) {
            throw new Exception('Exams group does not exist!');
        }

        $this->render('list', $info[0]['title']);
    }
}
