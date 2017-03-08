<?php

namespace Egzaminer;

use Exception;

class Auth
{
    private $users;

    public function __construct()
    {
        $configPath = dirname(__DIR__).'/config/users.php';
        if (!file_exists($configPath)) {
            throw new Exception('Config file users.php does not exist');
        }
        $this->users = include $configPath;
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
                $_SESSION['egzaminer_auth_un'] = $user['login'];
                $_SESSION['ga_cookie'] = password_hash($user['login'], PASSWORD_DEFAULT);

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
        if (!isset($_SESSION['ga_cookie'])) {
            return false;
        }

        foreach ($this->users as $user) {
            if (password_verify($user['login'], $_SESSION['ga_cookie'])
                && $_SESSION['egzaminer_auth_un'] === $user['login']) {
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
        $_SESSION['egzaminer_auth_un'] = false;
        $_SESSION['ga_cookie'] = false;

        return session_destroy();
    }
}
