<?php

namespace Egzaminer\Model;

use PDO;

class QuestionDeleteModel extends AbstractModel
{
    public function delete(int $questionID): bool
    {
        $stmt = $this->db->prepare('DELETE FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $questionID, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
