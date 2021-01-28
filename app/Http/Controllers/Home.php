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
class Home extends Controller
{

    /**
     * Show the index page
     * 
     * @return void
     */
    public function index()
    {
        dd('Home Index');
    }
}