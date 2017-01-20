<?php

use Egzaminer\Controller;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $controller = new Controller(['key' => 'value']);

        $this->assertEquals($controller->get('key'), 'value');
    }

    public function testGetWhenKeyNotExist()
    {
        $controller = new Controller([]);

        $this->assertNull($controller->get('key'));
    }

    public function testConfig()
    {
        $controller = new Controller([
            'config' => [
                'key' => 'value',
            ],
        ]);

        $this->assertEquals($controller->config('key'), 'value');
    }

    public function testConfigWhenKeyNotExist()
    {
        $controller = new Controller([
            'config' => [
                'null' => 'null',
            ],
        ]);

        $this->assertNull($controller->config('key'));
    }

    public function testGetFromRequest()
    {
        $controller = new Controller([
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ]);

        $this->assertEquals($controller->getFromRequest('type', 'key'), 'value');
    }

    public function testGetFromRequestWhenUnknowType()
    {
        $controller = new Controller([
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ]);

        $this->assertNull($controller->getFromRequest('unknow_type'));
    }

    public function testGetFromRequestForAll()
    {
        $controller = new Controller([
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ]);

        $this->assertEquals($controller->getFromRequest('type'), ['key' => 'value']);
    }

    public function testGetFromRequestWhenNoIndex()
    {
        $controller = new Controller([
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ]);

        $this->assertNull($controller->getFromRequest('type', 'other_key'));
    }

    public function testDir()
    {
        $controller = new Controller(['dir' => '/egzaminer']);

        $this->assertEquals($controller->dir(), '/egzaminer');
    }
}
