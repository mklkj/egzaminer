<?php

namespace Egzaminer\Roll;

use Egzaminer\Model;

class ExamsGroupModel extends Model
{
    public function getExamsGroups()
    {
        $stmt = $this->db->prepare('SELECT id, title, description FROM exams_groups');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getExamsGroupInfoById($groupID)
    {
        $stmt = $this->db->prepare('SELECT * FROM exams_groups WHERE id = :id');
        $stmt->bindValue(':id', $groupID, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}
