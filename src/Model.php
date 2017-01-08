<?php

namespace Egzaminer;

use PDO;

class Model
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
