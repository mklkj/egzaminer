<?php

namespace Tester\Model;

class OneTest extends Model
{
    public function getInfo($id)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM tests WHERE id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}
