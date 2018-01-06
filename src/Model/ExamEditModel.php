<?php

namespace Egzaminer\Model;

use PDO;

class ExamEditModel extends AbstractModel
{
    public function edit(int $examID, array $post): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE exams SET title = :title,
            questions = :questions, threshold = :threshold, group_id = :group_id
            WHERE id = :id'
        );
        $stmt->bindValue(':title', trim($post['title']));
        $stmt->bindValue(':questions', $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $post['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':group_id', $post['group_id'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
