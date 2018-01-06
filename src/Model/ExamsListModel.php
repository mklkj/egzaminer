<?php

namespace Egzaminer\Model;

use PDO;

class ExamsListModel extends AbstractModel
{
    public function getList(): array
    {
        $stmt = $this->db->query('SELECT id, title, questions FROM exams');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExamsByGroupId(int $groupID): array
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM exams WHERE group_id = :gid');
        $stmt->bindValue(':gid', $groupID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
