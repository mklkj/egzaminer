<?php

namespace Egzaminer\Model;

use PDO;

class QuestionsModel extends AbstractModel
{
    public function getByExamId(int $examID): array
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE exam_id = :exam_id');
        $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByQuestionId(int $questionID): array
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
