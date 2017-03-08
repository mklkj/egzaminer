<?php

namespace Egzaminer\Model;

use PDO;

class ExamModel extends AbstractModel
{
    /**
     * Get exam info by ID.
     *
     * @param int $examID Exam ID
     *
     * @param array
     */
    public function getInfo($examID)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions, threshold, group_id
            FROM exams WHERE id = :id');
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch();

        if ($data['questions'] > 0) {
            $data['thresholdPercentages'] = round($data['threshold'] / $data['questions'] * 100);
        }

        return $data;
    }
}
