<?php

use Egzaminer\Controller\AbstractController;
use PHPUnit\Framework\TestCase;

class AbstractControllerTest extends TestCase
{
    public function testGet()
    {
        $testData = ['key' => 'value'];

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
            ->getMockForAbstractClass();

        $this->assertEquals('value', $mock->get('key'));
    }

    public function testGetWhenKeyNotExist()
    {
        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([[]])
            ->getMockForAbstractClass();

        $this->assertNull($mock->get('key'));
    }

    public function testConfig()
    {
        $testData = [
            'config' => [
                'key' => 'value',
            ],
        ];

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
            ->getMockForAbstractClass();

        $this->assertEquals($mock->config('key'), 'value');
    }

    public function testConfigWhenKeyNotExist()
    {
        $testData = [
            'config' => [
                'null' => 'null',
            ],
        ];

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
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

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
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

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
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

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
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

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
            ->getMockForAbstractClass();

        $this->assertNull($mock->getFromRequest('type', 'other_key'));
    }

    public function testDir()
    {
        $testData = ['dir' => '/egzaminer'];

        /** @var AbstractController $mock */
        $mock = $this->getMockBuilder('Egzaminer\Controller\AbstractController')
            ->setConstructorArgs([$testData])
            ->getMockForAbstractClass();

        $this->assertEquals($mock->dir(), '/egzaminer');
    }
}
