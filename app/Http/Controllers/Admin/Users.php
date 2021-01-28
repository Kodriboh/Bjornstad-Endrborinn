<?php 

namespace app\Http\Controllers\Admin;

use core\Classes\Controller;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Users
 * 
 * PHP Version 8.0
 */
class Users extends Controller
{

    /**
     * Before filter
     *
     * @return void
     */
    protected function before()
    {

    }

    /**
     * After filter
     * 
     * @return void
     */
    protected function after() 
    {

    }

    /**
     * Show the index page
     * 
     * @return void
     */
    public function indexAction()
    {
        echo 'User index';
    }
}