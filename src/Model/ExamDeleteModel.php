<?php

namespace Egzaminer\Model;

use PDO;

class ExamDeleteModel extends AbstractModel
{
    public function delete(int $examID): bool
    {
        $stmt = $this->db->prepare('DELETE FROM exams WHERE id = :id');
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
