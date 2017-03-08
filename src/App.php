<?php

namespace Egzaminer;

use AltoRouter;
use Egzaminer\Auth;
use Exception;
use PDO;
use PDOException;
use Tamtamchik\SimpleFlash\Flash;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

class App
{
    const VERSION = '0.12.0';

    /**
     * @var string
     */
    private $url;

    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $container;

    /**
     * Constructor.
     *
     * @param string $url
     */
    public function __construct($url)
    {
        try {
            $configPath = $this->getRootDir().'/config/site.php';
            if (!file_exists($configPath)) {
                http_response_code(500);
                throw new Exception('Config file site.php does not exist');
            }
            $this->config = include $configPath;

            if ($this->config['debug']) {
                $whoops = new Whoops();
                $whoops->pushHandler(new PrettyPageHandler());
                $whoops->register();
            }

            $this->container = [
                'auth'    => new Auth(),
                'config'  => $this->config,
                'dbh'     => $this->dbConnect(include $this->getRootDir().'/config/db.php'),
                'dir'     => $this->getDir(),
                'flash'   => new Flash(),
                'request' => [
                    'get'     => $_GET,
                    'post'    => $_POST,
                    'session' => $_SESSION,
                    'cookie'  => $_COOKIE,
                    'files'   => $_FILES,
                    'server'  => $_SERVER,
                ],
                'rootDir' => $this->getRootDir(),
                'version' => self::VERSION,
            ];
        } catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
            $this->terminate();
        }

        $this->router = new AltoRouter();
        $this->setUrl($url);
    }

    /**
     * Run app.
     */
    public function invoke()
    {
        $this->router->map('GET', '/', [
            'Egzaminer\Controller\HomepageController', 'indexAction', ]);

        $this->router->map('GET', '/group/[i:id]', [
            'Egzaminer\Controller\ExamsGroupController', 'indexAction', ]);

        $this->router->map('GET|POST', '/exam/[i:id]', [
            'Egzaminer\Controller\ExamController', 'showAction', ]);

        $this->router->map('GET', '/admin', [
            'Egzaminer\Controller\DashboardController', 'indexAction', ]);

        $this->router->map('GET', '/admin/login', [
            'Egzaminer\Controller\LoginController', 'loginAction', ]);
        $this->router->map('POST', '/admin/login', [
            'Egzaminer\Controller\LoginController', 'postLoginAction', ]);

        $this->router->map('GET', '/admin/logout', [
            'Egzaminer\Controller\LogoutController', 'logoutAction', ]);

        $this->router->map('GET', '/admin/exam/add', [
            'Egzaminer\Controller\ExamAddController', 'addAction', ]);
        $this->router->map('POST', '/admin/exam/add', [
            'Egzaminer\Controller\ExamAddController', 'postAddAction', ]);

        $this->router->map('GET', '/admin/exam/edit/[i:id]', [
            'Egzaminer\Controller\ExamEditController', 'editAction', ]);
        $this->router->map('POST', '/admin/exam/edit/[i:id]', [
            'Egzaminer\Controller\ExamEditController', 'postEditAction', ]);

        $this->router->map('GET', '/admin/exam/del/[i:id]', [
            'Egzaminer\Controller\ExamDeleteController', 'deleteAction', ]);
        $this->router->map('POST', '/admin/exam/del/[i:id]', [
            'Egzaminer\Controller\ExamDeleteController', 'postDeleteAction', ]);

        $this->router->map('GET', '/admin/exam/edit/[i:id]/question/add', [
            'Egzaminer\Controller\QuestionAddController', 'addAction', ]);
        $this->router->map('POST', '/admin/exam/edit/[i:id]/question/add', [
            'Egzaminer\Controller\QuestionAddController', 'postAddAction', ]);

        $this->router->map('GET', '/admin/exam/edit/[i:id]/question/edit/[i:qid]', [
            'Egzaminer\Controller\QuestionEditController', 'editAction', ]);
        $this->router->map('POST', '/admin/exam/edit/[i:id]/question/edit/[i:qid]', [
            'Egzaminer\Controller\QuestionEditController', 'postEditAction', ]);

        $this->router->map('GET', '/admin/exam/edit/[i:id]/question/del/[i:qid]', [
            'Egzaminer\Controller\QuestionDeleteController', 'deleteAction', ]);
        $this->router->map('POST', '/admin/exam/edit/[i:id]/question/del/[i:qid]', [
            'Egzaminer\Controller\QuestionDeleteController', 'postDeleteAction', ]);

        $match = $this->router->match($this->url);

        try {
            // call closure or throw 404 status
            if ($match && is_callable($match['target'])) {
                call_user_func_array([
                    new $match['target'][0]($this->container), $match['target'][1],
                ], $match['params']);
            } else {
                throw new Exception('Page not exist! No route match');
            }
        } catch (Exception $e) {
            if ($this->config['debug']) {
                throw new DebugException($e->getMessage());
            } else {
                (new Error($this->container))->showAction(404);
            }
            $this->terminate();
        }
    }

    private function dbConnect(array $config)
    {
        try {
            $dsn = 'mysql'
            .':dbname='.$config['name']
            .';host='.$config['host']
            .';charset=utf8';

            $user = $config['user'];
            $password = $config['pass'];

            $dbh = new PDO($dsn, $user, $password);

            if ($this->config['debug']) {
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return $dbh;
        } catch (PDOException $e) {
            http_response_code(500);

            if ($this->config['debug']) {
                throw new DebugException($e->getMessage());
            } else {
                echo 'Error 500';
            }
            $this->terminate();
        }
    }

    public function terminate($code = 1)
    {
        exit($code);
    }

    /**
     * Set request url.
     *
     * @param string $request
     */
    public function setUrl($request)
    {
        $this->url = substr($request, strlen($this->getDir()));
    }

    /**
     * Get app root dir.
     *
     * @return string
     */
    public function getRootDir()
    {
        return dirname(__DIR__);
    }

    /**
     * Get app dir.
     *
     * @return string
     */
    public function getDir()
    {
        if (dirname($_SERVER['SCRIPT_NAME']) == '/') {
            return '';
        }

        return dirname($_SERVER['SCRIPT_NAME']);
    }
}
