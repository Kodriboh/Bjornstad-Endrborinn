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
     * @param array $args (optional) associative array of data to diplay in the view 
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

    /**
     * Render view template using Twig
     *
     * @param string $template - The template file
     * @param array array $args Associative array of data to display in the view (optional)
     * 
     * @return void
     */
    public static function renderTemplate($template, $args = []) 
    {
        static $twig = null;

        if ($twig == null) {
            $views_folder = \dirname(dirname(__DIR__)).'/resources/views/templates';
            $loader = new \Twig\Loader\FilesystemLoader($views_folder);
            $twig = new \Twig\Environment($loader, [
                'debug' => true,
                'charset' => 'utf-8',
                'cache' => '../App/cache',
                'optimizations' => 1,
            ]); 

            echo $twig->render($template, $args);
        }
    }
}