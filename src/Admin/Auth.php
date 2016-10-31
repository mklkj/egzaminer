<?php

namespace Tester\Admin;

class Auth
{
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
        $config = include dirname(dirname(__DIR__)).'/config.php';

        foreach ($config['users'] as $user) {
            if (password_verify($password, $user['pass_hash'])
                and $login === $user['login']) {
                $_SESSION['tester_auth_un'] = $user['login'];
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

        $config = include dirname(dirname(__DIR__)).'/config.php';

        foreach ($config['users'] as $user) {
            if (password_verify($user['login'], $_SESSION['ga_cookie'])
                and $_SESSION['tester_auth_un'] === $user['login']) {
                return true;
            }
        }
        return false;
    }
}
