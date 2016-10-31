<?php

namespace Tester\One;

use Tester\AbstractModel;

class OneTest extends AbstractModel
{
    public function getInfo($id)
    {
        $stmt = $this->db->prepare('SELECT id, title, questions, threshold FROM tests WHERE id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}
