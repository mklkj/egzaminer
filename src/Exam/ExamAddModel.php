<?php

namespace Egzaminer\Exam;

use PDO;
use Egzaminer\Model;

class ExamAddModel extends Model
{
    public function add($post)
    {
        $stmt = $this->db->prepare('INSERT INTO tests (title, questions, threshold, group_id)
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
