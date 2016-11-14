<?php

namespace Egzaminer\Roll;

use Egzaminer\Model;

class ExamsList extends Model
{
    public function getList()
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM tests');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getExamsByGroupId($gid)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM tests WHERE group_id = :gid');
        $stmt->bindValue(':gid', $gid, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
