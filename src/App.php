<?php

namespace Egzaminer;

use AltoRouter;

class App
{
    private $url;
    private $router;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->setUrl($_SERVER['REQUEST_URI']);
        $this->router = new AltoRouter();
        $this->addRoutes($this->router);
    }

    private function addRoutes($router)
    {
        $router->map('GET', '/', [
            'Egzaminer\Roll\HomePage', 'indexAction', ]);

        $router->map('GET|POST', '/test/[i:id]', [
            'Egzaminer\One\Test', 'showAction', ]);

        $router->map('GET', '/admin', [
            'Egzaminer\Admin\Dashboard', 'indexAction', ]);

        $router->map('GET|POST', '/admin/login', [
            'Egzaminer\Admin\Login', 'loginAction', ]);

        $router->map('GET|POST', '/admin/test/edit/[i:id]', [
            'Egzaminer\Admin\TestEdit', 'editAction', ]);

        $router->map('GET|POST', '/admin/test/edit/[i:tid]/question/edit/[i:qid]', [
            'Egzaminer\Admin\TestQuestionEdit', 'editAction', ]);

        $router->map('GET|POST', '/admin/test/edit/[i:tid]/question/add', [
            'Egzaminer\Admin\TestQuestionAdd', 'addAction', ]);

        $router->map('GET|POST', '/admin/test/add', [
            'Egzaminer\Admin\TestAdd', 'addAction', ]);
    }

    /**
     * Run app.
     */
    public function invoke()
    {
        $match = $this->router->match($this->url);

        // call closure or throw 404 status
        if ($match && is_callable($match['target'])) {
            call_user_func_array([
                new $match['target'][0](), $match['target'][1],
            ], $match['params']);
        } else {
            http_response_code(404);
            // echo 'Error 404 not found<pre>';
            // print_r($e->getMessage());
            include $this->getRootDir().'/web/templates/error.html.php';
        }
    }

    /**
     * Set request url.
     *
     * @param string $request
     */
    public function setUrl($request)
    {
        $basePath = $this->getDir();

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
