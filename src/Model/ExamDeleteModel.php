<?php

namespace Egzaminer\Model;

use PDO;

class ExamDeleteModel extends AbstractModel
{
    /**
     * Delete exam.
     *
     * @param int $examID
     *
     * @return bool
     */
    public function delete($examID)
    {
        $stmt = $this->db->prepare('DELETE FROM exams WHERE id = :id');
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
