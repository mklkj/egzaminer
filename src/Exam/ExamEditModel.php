<?php

namespace Egzaminer\Exam;

use PDO;
use Egzaminer\Model;

class ExamEditModel extends Model
{
    /**
     * Edit test.
     *
     * @param int   $id
     * @param array $test
     *
     * @return bool
     */
    public function edit($id, $post)
    {
        $stmt = $this->db->prepare('UPDATE tests SET title = :title,
            questions = :questions, threshold = :threshold WHERE id = :id'
        );
        $stmt->bindValue(':title', trim($post['title']), PDO::PARAM_STR);
        $stmt->bindValue(':questions', $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $post['threshold'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
