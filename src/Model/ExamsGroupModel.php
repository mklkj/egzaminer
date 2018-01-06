<?php

namespace Egzaminer\Model;

use PDO;

class ExamsGroupModel extends AbstractModel
{
    public function getExamsGroups(): array
    {
        $stmt = $this->db->query('SELECT id, title, description FROM exams_groups');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExamsGroupInfoById(int $groupID): \stdClass
    {
        $stmt = $this->db->prepare('SELECT * FROM exams_groups WHERE id = :id');
        $stmt->bindValue(':id', $groupID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
