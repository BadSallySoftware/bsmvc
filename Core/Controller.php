<?php
error_reporting(E_ALL);
class Controller
{
    
    public static function render($view, $vars)
    {
    
        foreach($vars as $key => $value)
        {
            $$key = $key;
            ${$key} = $value;
        }
        include BASEPATH . "App\\Views\\" . $view . ".php";

    }

    public static function Error404()
    {
        $title = "404 - Page Not Found";
        include BASEPATH . "App\\Views\\404.php";

    }
}