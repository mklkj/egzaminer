<?php

namespace Egzaminer\Model;

use PDO;

class QuestionsModel extends AbstractModel
{
    /**
     * Get questions by exam ID.
     *
     * @param int $examID Exam ID
     *
     * @return array
     */
    public function getByExamId($examID)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE exam_id = :exam_id');
        $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get question by ID.
     *
     * @param int $questionID Question ID
     *
     * @return array
     */
    public function getByQuestionId($questionID)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
