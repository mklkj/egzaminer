<?php

namespace Egzaminer;

class Auth
{
    /**
     * @var array
     */
    private $users;

    /**
     * @var array[]
     */
    private $request;

    public function __construct(array $users, array $request)
    {
        $this->users = $users;
        $this->request = $request;
    }

    public function login(string $login, string $password): bool
    {
        foreach ($this->users as $user) {
            if ($login === $user['login'] && password_verify($password, $user['pass_hash'])) {
                $this->request['session']['egzaminer_auth_un'] = $user['login'];
                $this->request['session']['ga_cookie'] = password_hash($user['login'], PASSWORD_DEFAULT);

                return true;
            }
        }

        return false;
    }

    public function isLogged(): bool
    {
        if (!isset($this->request['session']['ga_cookie'])) {
            return false;
        }

        foreach ($this->users as $user) {
            if ($this->request['session']['egzaminer_auth_un'] === $user['login']
                && password_verify($user['login'], $this->request['session']['ga_cookie'])) {
                return true;
            }
        }

        return false;
    }

    public function logout(): bool
    {
        $this->request['session']['egzaminer_auth_un'] = false;
        $this->request['session']['ga_cookie'] = false;

        return session_destroy();
    }
}
