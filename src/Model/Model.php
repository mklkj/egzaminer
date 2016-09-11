<?php

namespace Tester\Model;

abstract class Model
{
    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
}
