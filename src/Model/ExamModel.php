<?php

namespace Egzaminer\Model;

use PDO;

class ExamModel extends AbstractModel
{
    public function getInfo(int $examID): array
    {
        $stmt = $this->db->prepare('SELECT id, title, questions, threshold, group_id
            FROM exams WHERE id = :id');
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data['questions'] > 0) {
            $data['thresholdPercentages'] = round($data['threshold'] / $data['questions'] * 100);
        }

        if (empty($data)) {
            $data = [];
        }

        return $data;
    }
}
