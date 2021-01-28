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

require dirname(__DIR__).'/app/Http/Controllers/Posts.php';

$router = new Router;

$router->add('/', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['REQUEST_URI']);