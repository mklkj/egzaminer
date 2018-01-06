<?php

namespace Egzaminer\Model;

use PDO;

class ExamAddModel extends AbstractModel
{
    public function add(array $post): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO exams (title, questions, threshold, group_id)
            VALUES (:title, :questions, :threshold, :group_id)'
        );
        $stmt->bindValue(':title', trim($post['title']));
        $stmt->bindValue(':questions', (int) $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', (int) $post['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':group_id', (int) $post['group_id'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
