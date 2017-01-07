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
        $configSitePath = dirname(__DIR__).'/config/site.php';
        if (!file_exists($configSitePath)) {
            throw new Exception('Config site file does not exist');
        }
        $this->configSite = include $configSitePath;

        $configPath = dirname(__DIR__).'/config/db.php';

        if (!file_exists($configPath)) {
            throw new Exception('Config db file does not exist');
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
            if ($this->configSite['debug']) {
                echo $e->getMessage();
            } else {
                (new Error(404))->showAction();
            }
            die();
        }
    }
}
