<?php

namespace Tester\One;

use PDO;
use Tester\AbstractModel;

class Questions extends AbstractModel
{
    public function getByTestId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE test_id = :test_id');
        $stmt->bindValue(':test_id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getByQuestionId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
