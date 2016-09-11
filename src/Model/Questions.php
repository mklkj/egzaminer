<?php

namespace Tester\Model;

class Questions extends Model
{
    public function getByTestId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM questions WHERE test_id = :test_id');
        $stmt->bindValue(':test_id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
