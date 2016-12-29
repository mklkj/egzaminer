<?php

namespace Egzaminer;

use PDO;

class Model
{
    protected $db;

    public function __construct()
    {
        $config = include dirname(__DIR__).'/config/db.php';
        $dsn = 'mysql'
        .':dbname='.$config['name']
        .';host='.$config['host']
        .';charset=utf8';

        $user = $config['user'];
        $password = $config['pass'];

        $this->db = new PDO($dsn, $user, $password);
    }
}
