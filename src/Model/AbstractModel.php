<?php

namespace Egzaminer\Model;

use PDO;

abstract class AbstractModel
{
    /**
     * @var PDO
     */
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
}
