<?php

use Egzaminer\App;

class AppTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $_SESSION = [];
    }

    public function testGetRootDir()
    {
        $app = new App('test');

        $this->assertEquals(dirname(__DIR__), $app->getRootDir());
    }

    public function testGetDir()
    {
        $_SERVER['SCRIPT_NAME'] = '/';

        $app = new App('test');

        $this->assertEquals('', $app->getDir());
    }
}
