<?php

namespace Egzaminer\Model;

use PDO;

class ExamsGroupModel extends AbstractModel
{
    /**
     * Get exams groups.
     *
     * @return array
     */
    public function getExamsGroups()
    {
        $stmt = $this->db->prepare('SELECT id, title, description FROM exams_groups');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get exams group info by ID
     *
     * @param int $groupID Group ID
     *
     * @return object
     */
    public function getExamsGroupInfoById($groupID)
    {
        $stmt = $this->db->prepare('SELECT * FROM exams_groups WHERE id = :id');
        $stmt->bindValue(':id', $groupID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
