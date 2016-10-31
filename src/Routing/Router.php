<?php

namespace Tester\Routing;

class Router
{
    /**
     * @var string URL to processing
     */
    private $url;

    /**
     * @var string URL to the root catalog of app
     */
    private $basePath;

    /**
     * @var RouteCollection
     */
    private static $collection;

    /**
     * @var string name of controller with method name in matched route
     */
    private $controller = null;

    /**
     * @var array request params
     */
    private $params = [];

    /**
     * Constructor.
     *
     * @param RouteCollection
     */
    public function __construct($url, $basePath, RouteCollection $collection = null)
    {
        $this->setBasePath($basePath);
        $this->setUrl($url);

        if ($collection != null) {
            self::$collection = $collection;
        }
    }

    /**
     * Sets the url.
     *
     * @param string $url request url
     */
    private function setUrl($url)
    {
        $basePath = $this->getBasePath();

        if ($basePath) {
            $pos = strpos($url, $basePath);

            if (false !== $pos) {
                $url = substr_replace($url, '', $pos, strlen($basePath));
            }
        }
        $this->url = $url;
    }

    /**
     * Returns the url.
     *
     * @return string $url
     */
    public function getUrl()
    {
        return parse_url($this->url, PHP_URL_PATH);
    }

    /**
     * Sets the base path.
     *
     * @param string $basePath path to the root catalog of app
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Returns the base path.
     *
     * @return string $basePath
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Sets the RouteCollection.
     *
     * @param RouteCollection object with route pattern
     */
    private function setCollection(RouteCollection $collection)
    {
        self::$collection = $collection;
    }

    /**
     * Returns the RouteCollection object.
     *
     * @return RouteCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Returns the controller and method to run names.
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->controller;
    }

    /**
     * Returns array with params.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Looking for suitable rule matching URL. If it finds, returns true.
     *
     * @return bool
     */
    public function run()
    {
        if (!self::$collection->getAll()) {
            return false;
        }

        foreach (self::$collection->getAll() as $route) {
            if ($this->matchRoute($route)) {
                $this->setGetData($route);

                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the URL matches the handed rule.
     *
     * @param Route $route
     *
     * @return bool
     */
    protected function matchRoute($route)
    {
        $params = [];
        $routeParamsKey = array_keys($route->getParams());
        $routeParamsValue = $route->getParams();

        foreach ($routeParamsKey as $key) {
            $params['<'.$key.'>'] = $routeParamsValue[$key];
        }

        $url = $route->getPath();

        // Zamienia znaczniki na odpowiednie wyrażenia regularne
        $url = str_replace(array_keys($params), $params, $url);

        // Jeżeli brak znacznika w tablicy $params zezwala na dowolny znak
        $url = preg_replace('/<\w+>/', '.*', $url);

        // sprawdza dopasowanie do wzorca
        preg_match("#^$url$#", $this->getUrl(), $results);

        if ($results) {
            $this->controller = $route->getControllerName();

            return true;
        }

        return false;
    }

    /**
     * @param Route $route Obiekt Route pasujący do reguły
     */
    protected function setGetData($route)
    {
        $routePath = str_replace(array('(', ')'), array('', ''), $route->getPath());
        $trim = explode('<', $routePath);
        $parsed_url = str_replace(array($this->basePath), array(''), $this->getUrl());
        $parsed_url = preg_replace("#$trim[0]#", '', $parsed_url, 1);

        // ustawia parametry przekazane w URL
        foreach ($route->getParams() as $key => $param) {
            preg_match("#$param#", $parsed_url, $results);
            if (isset($results[0])) {
                $this->params[$key] = $results[0];
                $parsed_url = preg_replace('#'.$results[0].'#', '', $parsed_url, 1);
            }
        }

        // jezeli brak parametru w URL ustawia go z tablicy wartości domyślnych
        foreach ($route->getDefaults() as $key => $default) {
            if (!isset($this->params[$key])) {
                $this->params[$key] = $default;
            }
        }
    }
}
