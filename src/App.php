<?php

namespace Egzaminer;

use AltoRouter;
use Egzaminer\Admin\Auth;
use Exception;
use PDO;

class App
{
    private $url;
    private $router;
    private $config;
    private $container;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->config = include $this->getRootDir().'/config/site.php';

        $this->container = [
            'auth' => new Auth(),
            'dbh' => $this->dbConnect(include $this->getRootDir().'/config/db.php'),
            'config' => $this->config,
            'dir' => $this->getDir(),
            'rootDir' => $this->getRootDir(),
        ];

        $this->router = new AltoRouter();
        $this->setUrl($_SERVER['REQUEST_URI']);
    }

    /**
     * Run app.
     */
    public function invoke()
    {
        $this->router->map('GET', '/', [
            'Egzaminer\Roll\HomePage', 'indexAction', ]);

        $this->router->map('GET', '/group/[i:id]', [
            'Egzaminer\Roll\ExamsGroup', 'indexAction', ]);

        $this->router->map('GET|POST', '/test/[i:id]', [
            'Egzaminer\Exam\Exam', 'showAction', ]);

        $this->router->map('GET', '/admin', [
            'Egzaminer\Admin\Dashboard', 'indexAction', ]);

        $this->router->map('GET|POST', '/admin/login', [
            'Egzaminer\Admin\Login', 'loginAction', ]);

        $this->router->map('GET|POST', '/admin/logout', [
            'Egzaminer\Admin\Logout', 'logoutAction', ]);

        $this->router->map('GET|POST', '/admin/test/add', [
            'Egzaminer\Exam\ExamAdd', 'addAction', ]);

        $this->router->map('GET|POST', '/admin/test/edit/[i:id]', [
            'Egzaminer\Exam\ExamEdit', 'editAction', ]);

        $this->router->map('GET|POST', '/admin/test/del/[i:id]', [
            'Egzaminer\Exam\ExamDelete', 'deleteAction', ]);

        $this->router->map('GET|POST', '/admin/test/edit/[i:tid]/question/add', [
            'Egzaminer\Question\QuestionAdd', 'addAction', ]);

        $this->router->map('GET|POST', '/admin/test/edit/[i:tid]/question/edit/[i:qid]', [
            'Egzaminer\Question\QuestionEdit', 'editAction', ]);

        $this->router->map('GET|POST', '/admin/test/edit/[i:tid]/question/del/[i:qid]', [
            'Egzaminer\Question\QuestionDelete', 'deleteAction', ]);

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
                echo $e->getMessage();
            } else {
                (new Error($this->container))->showAction(404);
            }
            exit;
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
        } catch (PDOException $e) {
            http_response_code(500);

            if ($this->config['debug']) {
                echo $e->getMessage();
            } else {
                'Error 500';
            }

            die;
        }

        return $dbh;
    }

    /**
     * Set request url.
     *
     * @param string $request
     */
    public function setUrl($request)
    {
        $basePath = $this->getDir();
        $url = null;

        if ($basePath) {
            $pos = strpos($request, $basePath);

            if (false !== $pos) {
                $url = substr_replace($request, '', $pos, strlen($basePath));
            }
        }
        $this->url = $url;
    }

    /**
     * Get app root dir.
     *
     * @return string
     */
    public static function getRootDir()
    {
        return dirname(__DIR__);
    }

    public function dir()
    {
        return $this->getDir();
    }

    /**
     * Get app dir.
     *
     * @return string
     */
    public static function getDir()
    {
        if (dirname($_SERVER['SCRIPT_NAME']) == '/') {
            return '';
        } else {
            return dirname($_SERVER['SCRIPT_NAME']);
        }
    }
}
