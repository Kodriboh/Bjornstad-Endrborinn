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
    public function indexAction() 
    {
        echo 'Called: Post Index';
    }

    /**
     * Show the create page
     *
     * @return void
     */
    public function createAction()
    {
        echo 'Called: Post Create';
    }

    /**
     * Show the udpate page
     * 
     * @return void
     */
    public function editAction()
    {
        echo 'Called: Post Edit';
    }

    /**
     * After filter
     * 
     * @return void
     */
    protected function after()
    {
        echo " (after)";
    }

    /**
     * Before filter
     * 
     * @return void
     */
    public function before() 
    {
        echo "(before) ";
    }
}