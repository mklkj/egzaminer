<?php

namespace Egzaminer\Exam;

use Egzaminer\Model;
use PDO;

class ExamDeleteModel extends Model
{
    /**
     * Delete test.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM tests WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
