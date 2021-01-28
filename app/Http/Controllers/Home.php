<?php 

namespace app\Http\Controllers;

use core\Classes\Controller;
use core\Classes\View;

/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * Post Controller
 * 
 * PHP Version 8.0
 */
class Home extends Controller
{

    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        View::render('Home/welcome.php', [
            'name' => 'Luke',
            'colors' => ['red', 'green', 'blue']
        ]);
    }
}