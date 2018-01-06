<?php

use Egzaminer\Tests\Controller\EgzaminerTestsControllerTestCase;

class LogoutControllerTest extends EgzaminerTestsControllerTestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testLogoutAction()
    {
        session_start();

        $mock = $this->getMockBuilder('Egzaminer\Controller\LogoutController')
            ->setConstructorArgs([$this->container])
            ->setMethods(['redirect'])
            ->getMock();

        $mock->expects($this->once())
            ->method('redirect');

        $this->assertNull($mock->logoutAction());
    }
}
