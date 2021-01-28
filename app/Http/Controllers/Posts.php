<?php 

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
        dd('Post Index');
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