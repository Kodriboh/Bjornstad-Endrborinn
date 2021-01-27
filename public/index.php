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
$router->add('/Posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('api/{action}/{controller}');

dd(htmlspecialchars(print_r($router->getRoutes(), true)));