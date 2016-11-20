<?php

namespace Egzaminer\Exam;

use Egzaminer\Model;

class ExamModel extends Model
{
    public function getInfo($id)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions, threshold, group_id
            FROM tests WHERE id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}
