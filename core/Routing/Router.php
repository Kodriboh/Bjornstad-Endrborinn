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
    protected array $routes = [];

    /**
     * Parameters from the matched route.
     * @var array
     */
    protected array $params = [];

    /**
     * Add a route to the routing table.
     * 
     * @param string $route the route URL
     * @param array $params Parameters (controller, action, params).
     * 
     * @return void
     */
    public function add(string $route, array $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

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
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

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

    public function dispatch(string $url)
    {
        $url = ltrim($this->removeQueryStringVariables($url), '/');

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToPascalCase($controller);
            $controller = "app\Http\Controllers\\$controller";

            if (\class_exists($controller)) {
                $controller_object = new $controller();

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if (\is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    echo "Method $action (in controller $controller_object) not found";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo 'No route matched.';
        }
    }

    /**
     * Converts a string to PascalCase
     *
     * @param string $string the string to convert
     * @return string the converted string
     */
    public function convertToPascalCase(string $string) 
    {
        return \str_replace(' ', '', \ucwords(\str_replace('-', ' ', $string)));
    }

    /**
     * Cinverts a string to camelCase
     *
     * @params string $string the string to convert
     * @return void
     */
    public function convertToCamelCase(string $string) 
    {
        return \lcfirst($this->convertToPascalCase($string));
    }

    /**
     * Remove the query string variables from the URL (if any). As the full
     * query string is used for the route, any variables at the end will need
     * to be removed before the route is matched to the routing table. For
     * example:
     *
     *   URL                         $_GET['url]              Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * A URL of the format localhost/?page (one variable name, no value) won't
     * work however. (NB. The .htaccess file converts the first ? to a & when
     * it's passed through to the $_SERVER variable).
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    public function removeQueryStringVariables(string $url) 
    {
        if ($url != '') {
            $parts = explode('?', $url, 2);
            
            if (strpos($parts[0], '=') == false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}