<?php 

namespace app\Http\Controllers;

use core\Classes\Controller;

/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * Post Controller
 * 
 * PHP Version 8.0
 */
class Posts extends Controller
{
    /**
     * Show the index page
     *
     * @return view index
     */
    public function index() 
    {
        echo 'Hello from the posts controller';
        echo '<p>Query string parameters: <pre>' .
            \htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
    }

    /**
     * Show the create page
     *
     * @return void
     */
    public function create()
    {
        dd('Post Create');
    }

    /**
     * Show the udpate page
     * 
     * @return void
     */
    public function edit()
    {
        echo '<p>Route parameters: </p>' . 
            \htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}