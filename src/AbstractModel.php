<?php

namespace Tester;

use PDO;

class AbstractModel
{
    protected $db;

    public function __construct()
    {
        $config = include dirname(__DIR__).'/config.php';
        $dsn = 'mysql'
        .':dbname='.$config['db']['name']
        .';host='.$config['db']['host']
        .';charset=utf8';

        $user = $config['db']['user'];
        $password = $config['db']['pass'];

        $this->db = new PDO($dsn, $user, $password);
    }
}
