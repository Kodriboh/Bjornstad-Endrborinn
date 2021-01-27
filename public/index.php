<?php

use core\Routing\Router; 

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Front Controller
 * 
 * PHP Version 8.0
 */
require_once dirname(__DIR__).'/core/bootstrap.php';

$router = new Router;

$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('/posts', ['contorller' => 'PostController', 'action' => 'index']);
$router->add('/posts/new', ['controller' => 'Posts', 'action' => 'new']);

$url = $_SERVER['REQUEST_URI'];

if ($router->match($url)) {
    dd($router->getParams());
} else {
    echo "No route found for URL '$url'";
}