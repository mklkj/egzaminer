<?php

namespace Egzaminer;

class Auth
{
    /**
     * @var array
     */
    private $users;

    /**
     * @var array
     */
    private $request;

    /**
     * Construct.
     *
     * @param array $users
     * @param array $request
     */
    public function __construct(array $users, array $request)
    {
        $this->users = $users;
        $this->request = $request;
    }

    /**
     * Login.
     *
     * @param string $login
     * @param string $password
     *
     * @return bool
     */
    public function login($login, $password)
    {
        foreach ($this->users as $user) {
            if (password_verify($password, $user['pass_hash'])
                && $login === $user['login']) {
                $this->request['session']['egzaminer_auth_un'] = $user['login'];
                $this->request['session']['ga_cookie'] = password_hash($user['login'], PASSWORD_DEFAULT);

                return true;
            }
        }

        return false;
    }

    /**
     * Verify is usser logged.
     */
    public function isLogged()
    {
        if (!isset($this->request['session']['ga_cookie'])) {
            return false;
        }

        foreach ($this->users as $user) {
            if (password_verify($user['login'], $this->request['session']['ga_cookie'])
                && $this->request['session']['egzaminer_auth_un'] === $user['login']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Logout user.
     *
     * @return bool
     */
    public function logout()
    {
        $this->request['session']['egzaminer_auth_un'] = false;
        $this->request['session']['ga_cookie'] = false;

        return session_destroy();
    }
}
