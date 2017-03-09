<?php

namespace Egzaminer\Model;

use PDO;

abstract class AbstractModel
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * Contructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
}
