<?php

namespace Egzaminer\Exam;

use Egzaminer\Model;
use PDO;

class ExamAddModel extends Model
{
    public function add($post)
    {
        $stmt = $this->db->prepare('INSERT INTO exams (title, questions, threshold, group_id)
            VALUES (:title, :questions, :threshold, :group_id)'
        );
        $stmt->bindValue(':title', trim($post['title']), PDO::PARAM_STR);
        $stmt->bindValue(':questions', $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $post['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':group_id', $post['group_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
