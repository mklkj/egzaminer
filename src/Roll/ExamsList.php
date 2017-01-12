<?php

namespace Egzaminer\Roll;

use Egzaminer\Model;

class ExamsList extends Model
{
    public function getList()
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM exams');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getExamsByGroupId($groupID)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM exams WHERE group_id = :gid');
        $stmt->bindValue(':gid', $groupID, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
