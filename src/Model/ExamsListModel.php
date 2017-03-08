<?php

namespace Egzaminer\Model;

use PDO;

class ExamsListModel extends AbstractModel
{
    /**
     * Get exams list.
     *
     * @return array
     */
    public function getList()
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM exams');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get exams list by group ID.
     *
     * @param int $groupID Group ID
     *
     * @return array
     */
    public function getExamsByGroupId($groupID)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM exams WHERE group_id = :gid');
        $stmt->bindValue(':gid', $groupID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
