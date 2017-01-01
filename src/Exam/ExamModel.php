<?php

namespace Egzaminer\Exam;

use Egzaminer\Model;
use PDO;

class ExamModel extends Model
{
    public function getInfo($id)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions, threshold, group_id
            FROM tests WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch();
        $data['thresholdPercentages'] = round($data['threshold'] / $data['questions'] * 100);

        return $data;
    }
}
