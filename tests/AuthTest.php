<?php

use Egzaminer\Auth;

class AuthTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->users = [
            [
                'login'     => 'admin',
                'pass_hash' => password_hash('admin', PASSWORD_DEFAULT),
            ],
        ];

        $this->request = [
            'session' => [
                'ga_cookie' => '',
                'egzaminer_auth_un' => '',
            ],
        ];
    }

    public function testLogin()
    {
        $auth = new Auth($this->users, $this->request);

        $this->assertTrue($auth->login('admin', 'admin'));
    }

    public function testLoginWrongPassword()
    {
        $auth = new Auth($this->users, $this->request);

        $this->assertFalse($auth->login('admin', 'admin1'));
    }

    public function testIsLoggedWhenNoSession()
    {
        $auth = new Auth($this->users, $this->request);

        $this->assertFalse($auth->isLogged());
    }

    public function testIsLogged()
    {
        $auth = new Auth($this->users, [
            'session' => [
                'ga_cookie' => password_hash('admin', PASSWORD_DEFAULT),
                'egzaminer_auth_un' => 'admin',
            ],
        ]);

        $this->assertTrue($auth->isLogged());
    }

    public function testIsLoggedWhenNoLogged()
    {
        unset($this->request['session']['ga_cookie']);
        $auth = new Auth($this->users, $this->request);

        $this->assertFalse($auth->isLogged());
    }

    /**
    * @runInSeparateProcess
    */
    public function testLogout()
    {
        session_start();
        $auth = new Auth($this->users, $this->request);

        $this->assertTrue($auth->logout());
    }
}
