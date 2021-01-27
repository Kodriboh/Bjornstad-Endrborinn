<?php 

namespace core\Routing;

/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * Router
 * 
 * PHP Version 8.0
 */
class Router
{
    /**
     * Associative array of routes (the routing table).
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched route.
     * @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table.
     * 
     * @param string $route the route URL
     * @param array $params Parameters (controller, action, params).
     * 
     * @return void
     */
    public function add(string $route, array $params) 
    {
        $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table.
     * 
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params 
     * property if a route is found.
     * 
     * @param string $url the route URL
     * 
     * @return boolean true if a match is found, else false
     */
    public function match(string $url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Get the currently matched parameters.
     * 
     * @return array
     */
    public function getParams() 
    {
        return $this->params;
    }
}