<?php

namespace Egzaminer;

use AltoRouter;
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
        $this->config = $this->loadConfig('site');
        try {
            if ($this->config['debug']) {
                $whoops = new Whoops();
                $whoops->pushHandler(new PrettyPageHandler());
                $whoops->register();
            }

            $this->container = [
                'config'  => $this->config,
                'dbh'     => $this->dbConnect($this->loadConfig('db')),
                'dir'     => $this->getDir(),
                'flash'   => new Flash(),
                'request' => [
                    'get'     => $_GET,
                    'post'    => $_POST,
                    'session' => &$_SESSION,
                    'files'   => $_FILES,
                ],
                'rootDir' => $this->getRootDir(),
                'version' => self::VERSION,
            ];

            $this->container['auth'] = new Auth($this->loadConfig('users'), $this->container['request']);
        } catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
            $this->terminate();
        }

        $this->router = new AltoRouter();
        $this->setUrl($url);
    }

    /**
     * Get config.
     *
     * @param string $name Config filename
     *
     * @return array
     */
    public function loadConfig($name)
    {
        $path = dirname(__DIR__).'/config/'.$name.'.php';
        try {
            if (!file_exists($path)) {
                http_response_code(500);
                throw new Exception('Config file '.$name.'.php does not exist');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->terminate();
        }

        return include $path;
    }

    /**
     * Run app.
     */
    public function invoke()
    {
        $this->loadRoutes();

        $match = $this->router->match($this->url);

        try {
            // call closure or throw 404 status
            if ($match && is_callable($match['target'])) {
                echo call_user_func_array([
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

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        $routesArray = include __DIR__.'/routes.php';

        foreach ($routesArray as $key => $route) {
            if (2 === count($route)) {
                $this->router->map(
                    $route[0][0],
                    $route[0][1],
                    [
                        'Egzaminer\Controller\\'.$route[0][2][0],
                        $route[0][2][1],
                    ],
                    $key.'/'.$route[0][0]
                );
                $route = $route[1];
            }

            $this->router->map(
                $route[0],
                $route[1],
                [
                    'Egzaminer\Controller\\'.$route[2][0],
                    $route[2][1],
                ],
                $key.'/'.$route[0]
            );
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
