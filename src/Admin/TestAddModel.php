<?php

namespace Tester\Admin;

use PDO;
use Tester\AbstractModel;

class TestAddModel extends AbstractModel
{
    public function add($post)
    {
        $stmt = $this->db->prepare('INSERT INTO tests (title, questions, threshold)
            VALUES (:title, :questions, :threshold)'
        );
        $stmt->bindValue(':title', trim($post['title']), PDO::PARAM_STR);
        $stmt->bindValue(':questions', $post['questions'], PDO::PARAM_INT);
        $stmt->bindValue(':threshold', $post['threshold'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
