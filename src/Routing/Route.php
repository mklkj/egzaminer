<?php

namespace Egzaminer\Routing;

class Route
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $defaults = [];

    /**
     * @var int
     */
    private $priority;

    /**
     * Constructor.
     *
     * @param array $controllerName Controller to use for route
     * @param array $params         Params
     * @param array $defaults       An array of default parameter values
     * @param int   $priority       Route priority
     */
    public function __construct($path, $controllerName, array $params = [], array $defaults = [], $priority = 1000)
    {
        $this->setPath($path);
        $this->setControllerName($controllerName);
        $this->setParams($params);
        $this->setDefaults($defaults);
        $this->setPriority($priority);
    }

    /**
     * Sets the pattern for the path.
     *
     * @param string $pattern The path pattern
     */
    private function setPath($path)
    {
        $this->path = '/'.ltrim(trim($path), '/');
    }

    /**
     * Returns the path.
     *
     * @return string $path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the controller name to use for route.
     *
     * @param string $controllerName The controller name
     */
    private function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * Returns the controller name.
     *
     * @return array $controllerName 
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * Sets the params.
     *
     * @param array $params The params
     */
    private function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Returns the params.
     *
     * @return array $params 
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Returns the priority.
     *
     * @return array $priority 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Sets the defaults.
     *
     * @param array $defaults The defaults
     */
    private function setDefaults(array $defaults)
    {
        $this->defaults = $defaults;
    }

    /**
     * Sets the priority.
     *
     * @param int $priority The priority
     */
    private function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Returns the defaults params.
     *
     * @return array $defaults The defaults params
     */
    public function getDefaults()
    {
        return $this->defaults;
    }
}
