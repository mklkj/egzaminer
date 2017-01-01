<?php

namespace Egzaminer;

use Exception;
use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        $configPath = dirname(__DIR__).'/config/db.php';

        if (!file_exists($configPath)) {
            throw new Exception('Config file does not exist');
        }

        $config = include $configPath;

        try {
            $dsn = 'mysql'
            .':dbname='.$config['name']
            .';host='.$config['host']
            .';charset=utf8';

            $user = $config['user'];
            $password = $config['pass'];

            $this->db = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
    }
}
