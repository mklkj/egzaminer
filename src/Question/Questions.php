<?php

namespace Egzaminer\Question;

use Egzaminer\Model;
use PDO;

class Questions extends Model
{
    public function getByExamId($examID)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE exam_id = :exam_id');
        $stmt->bindValue(':exam_id', $examID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getByQuestionId($questionID)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
