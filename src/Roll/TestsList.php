<?php

namespace Egzaminer\Roll;

use Egzaminer\AbstractModel;

class TestsList extends AbstractModel
{
    public function getList()
    {
        $stmt = $this->db->prepare('SELECT id, title, questions FROM tests');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
