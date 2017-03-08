<?php

namespace Egzaminer\Model;

use PDO;

class ExamEditModel extends AbstractModel
{
    /**
     * Edit exam.
     *
     * @param int   $examID
     * @param array $post
     *
     * @return bool
     */
    public function edit($examID, $post)
    {
        $stmt = $this->db->prepare('UPDATE exams SET title = :title,
            questions = :questions, threshold = :threshold, group_id = :group_id
            WHERE id = :id'
        );
        $stmt->bindValue(':title', trim($post['title']), PDO::PARAM_STR);
        $stmt->bindValue(':questions', $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $post['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':group_id', $post['group_id'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $examID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
