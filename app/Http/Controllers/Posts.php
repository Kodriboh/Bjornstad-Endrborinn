<?php 

namespace app\Http\Controllers;
/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * Post Controller
 * 
 * PHP Version 8.0
 */
class Posts
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
}