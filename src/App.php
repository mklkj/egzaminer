<?php

namespace Tester;

use Tester\Routing\FrontController;
use Tester\Routing\Route;
use Tester\Routing\RouteCollection;
use Tester\Routing\Router;
use Exception;

class App
{
    private $routes;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->routes = new RouteCollection();

        $this->routes->add('index', new Route('/',
            'Tester\Roll\HomePage::indexAction'
        ));

        $this->routes->add('test', new Route('test/<id>$',
            'Tester\One\Test::showAction',
            ['id' => '[1-9][0-9]*']
        ));

        $this->routes->add('admin/login', new Route('admin/login(/)?',
            'Tester\Admin\Login::loginAction'
        ));

        $this->routes->add('admin/dashboard', new Route('admin(/)?',
            'Tester\Admin\Dashboard::indexAction'
        ));

        $this->routes->add('admin/test/edit', new Route('admin/test/edit/<id>$',
            'Tester\Admin\TestEdit::editAction',
            ['id' => '[1-9][0-9]*']
        ));
    }

    /**
     * Run app.
     */
    public function invoke()
    {
        $router = new Router($_SERVER['REQUEST_URI'], static::getDir(), $this->routes);
        $frontController = new FrontController($router);

        try {
            $frontController->run();
        } catch (Exception $e) {
            http_response_code(404);
            // echo 'Error 404 not found<pre>';
            // print_r($e->getMessage());
            include $this->getRootDir().'/web/templates/error.html.php';
        }
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
