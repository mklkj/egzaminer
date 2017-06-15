<?php

use Egzaminer\Auth;
use Tamtamchik\SimpleFlash\Flash;

abstract class EgzaminerTestsControllerTestCase extends EgzaminerTestsDatabaseTestCase
{
    public function getDataSet()
    {
        return new EgzaminerArrayDataSet([]);
    }

    public function setUp()
    {
        parent::setUp();
        $_SESSION = [
            'flash_messages' => [],
        ];
        $this->container = [
            'config'  => [
                'title'           => 'Egzaminer',
                'title_divider'   => '|',
                'theme'           => 'mdl',
                'homepage-header' => 'Exams',
                'cache'           => false,
                'debug'           => false,
            ],
            'dbh'     => self::$pdo,
            'dir'     => 'test',
            'flash'   => new Flash(),
            'request' => [
                'post'    => $_POST,
                'session' => &$_SESSION,
                'files'   => $_FILES,
            ],
            'rootDir' => dirname(dirname(__DIR__)),
            'version' => '1-test',
        ];

        $this->container['auth'] = new Auth([[
            'login'     => 'admin',
            'pass_hash' => password_hash('admin', PASSWORD_DEFAULT),
        ]], $this->container['request']);
    }
}
