<?php

namespace Egzaminer\Question;

use Egzaminer\Model;
use PDO;

class QuestionDeleteModel extends Model
{
    /**
     * Delete question.
     *
     * @param int $questionID
     *
     * @return bool
     */
    public function delete($questionID)
    {
        $stmt = $this->db->prepare('DELETE FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
