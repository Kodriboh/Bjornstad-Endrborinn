<?php

namespace core\Classes;

/**
 * Bjornstad
 * @Author Luke McCann
 * 
 * View
 * 
 * PHP Version 8.0
 */
class View 
{

    /**
     * Render a view file
     * 
     * @param string $view The view file
     * 
     * @return void
     */
    public static function render(string $view, array $args = [])
    {
        \extract($args, \EXTR_SKIP);
        
        $file = dirname(dirname(__DIR__))."/resources/views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception('View does not exist!', 404);
        }
    }
}