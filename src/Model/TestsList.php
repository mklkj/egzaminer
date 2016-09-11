<?php

namespace Tester\Model;

class TestsList extends Model
{
    public function getList()
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM tests');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
