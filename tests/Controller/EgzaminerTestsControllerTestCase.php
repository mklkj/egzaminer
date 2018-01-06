<?php

namespace Egzaminer\Tests\Controller;

use Egzaminer\Auth;
use Egzaminer\Tests\Model\EgzaminerArrayDataSet;
use Egzaminer\Tests\Model\EgzaminerTestsDatabaseTestCase;
use Tamtamchik\SimpleFlash\Flash;

abstract class EgzaminerTestsControllerTestCase extends EgzaminerTestsDatabaseTestCase
{
    /**
     * @var array
     */
    protected $container;

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
            'rootDir' => \dirname(__DIR__, 2),
            'version' => '1-test',
        ];

        $this->container['auth'] = new Auth([[
            'login'     => 'admin',
            'pass_hash' => password_hash('admin', PASSWORD_DEFAULT),
        ]], $this->container['request']);
    }
}
