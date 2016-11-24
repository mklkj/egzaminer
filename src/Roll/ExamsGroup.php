<?php

namespace Egzaminer\Roll;

use Egzaminer\Controller;

class ExamsGroup extends Controller
{
    public function indexAction($examId)
    {
        $list = new ExamsList();
        $this->data['exams_list'] = $list->getExamsByGroupId($examId);

        $one = new ExamsGroupModel();
        $info = $one->getExamsGroupInfoById($examId);
        $this->render('list', $info[0]['title']);
    }
}
