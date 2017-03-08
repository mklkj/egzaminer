<?php

use Egzaminer\Controller\AbstractController;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $testData = ['key' => 'value'];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertEquals('value', $mock->get('key'));
    }

    public function testGetWhenKeyNotExist()
    {
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array([]))
            ->getMockForAbstractClass();

        $this->assertNull($mock->get('key'));
    }

    public function testConfig()
    {
        $testData = [
            'config' => [
                'key' => 'value',
            ]
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertEquals($mock->config('key'), 'value');
    }

    public function testConfigWhenKeyNotExist()
    {
        $testData = [
            'config' => [
                'null' => 'null',
            ]
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertNull($mock->config('key'));
    }

    public function testGetFromRequest()
    {
        $testData = [
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertEquals($mock->getFromRequest('type', 'key'), 'value');
    }

    public function testGetFromRequestWhenUnknowType()
    {
        $testData = [
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertNull($mock->getFromRequest('unknow_type'));
    }

    public function testGetFromRequestForAll()
    {
        $testData = [
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertEquals($mock->getFromRequest('type'), ['key' => 'value']);
    }

    public function testGetFromRequestWhenNoIndex()
    {
        $testData = [
            'request' => [
                'type' => [
                    'key' => 'value',
                ],
            ],
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertNull($mock->getFromRequest('type', 'other_key'));
    }

    public function testDir()
    {
        $testData = ['dir' => '/egzaminer'];

        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs(array($testData))
            ->getMockForAbstractClass();

        $this->assertEquals($mock->dir(), '/egzaminer');
    }
}
