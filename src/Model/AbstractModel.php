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
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
