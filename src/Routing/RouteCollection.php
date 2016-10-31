<?php

namespace Tester\Routing;

class RouteCollection
{
    /**
     * @var array
     */
    private $collection;

    /**
     * Adds a route.
     *
     * @param string $name The route name
     * @param Route  $item A Route instance
     */
    public function add($name, Route $item)
    {
        $this->collection[$name] = $item;
    }

    /**
     * Gets a route by name.
     *
     * @param string $name The route name
     *
     * @return Route|null
     */
    public function get($name)
    {
        if (!isset($this->collection[$name])) {
            return;
        }

        return $this->collection[$name];
    }

    /**
     * Returns all routes in this collection.
     *
     * @return Route array An array of routes collection
     */
    public function getAll()
    {
        if (empty($this->collection)) {
            return false;
        }

        return $this->collection;
    }
}
