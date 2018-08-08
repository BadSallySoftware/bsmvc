<?php
error_reporting(E_ALL);
class Controller
{
    
    public function render($view, $vars)
    {
    
        foreach($vars as $key => $value)
        {
            $$key = $key;
            ${$key} = $value;
        }
        include BASEPATH . "App\\Views\\" . $view . ".php";

    }
}