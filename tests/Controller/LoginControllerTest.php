<?php

use Egzaminer\Controller\LoginController;

class LoginControllerTest extends EgzaminerTestsControllerTestCase
{
    public function testLoginAction()
    {
        $controller = new LoginController($this->container);

        $this->assertInternalType('string', $controller->loginAction());
    }

    public function testLoginActionWhenAlreadyLogged()
    {
        $this->container['request']['session'] = [
            'ga_cookie' => password_hash('admin', PASSWORD_DEFAULT),
            'egzaminer_auth_un' => 'admin',
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\LoginController')
            ->setConstructorArgs([$this->container])
            ->setMethods(['terminate', 'redirect'])
            ->getMock();

        $mock->expects($this->once())
            ->method('terminate');

        $mock->expects($this->once())
            ->method('redirect');

        $this->assertNull($mock->loginAction());
    }

    public function testPostLoginAction()
    {
        $this->container['request']['post'] = [
            'username' => 'admin',
            'password' => 'admin',
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\LoginController')
            ->setConstructorArgs([$this->container])
            ->setMethods(['terminate', 'redirect'])
            ->getMock();

        $mock->expects($this->once())
            ->method('terminate');

        $mock->expects($this->once())
            ->method('redirect');

        $this->assertNull($mock->postLoginAction());
    }

    public function testPostLoginActionWrongPassword()
    {
        $this->container['request']['post'] = [
            'username' => 'admin',
            'password' => 'admin1',
        ];

        $mock = $this->getMockBuilder('Egzaminer\Controller\LoginController')
            ->setConstructorArgs([$this->container])
            ->setMethods(['redirect'])
            ->getMock();

        $mock->expects($this->once())
            ->method('redirect');

        $this->assertNull($mock->postLoginAction());
    }
}
