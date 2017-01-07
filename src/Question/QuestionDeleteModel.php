<?php

namespace Egzaminer\Question;

use Egzaminer\Model;
use PDO;

class QuestionDeleteModel extends Model
{
    /**
     * Delete question.
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
