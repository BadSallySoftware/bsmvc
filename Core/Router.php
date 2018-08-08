<?php
error_reporting(E_ALL);
class Router{

    private function __contstruct(){}
           

    public static function dispatch($path)
    {
        //Break the url appart
        $pathParts = explode("/", $path);
        
        $route["file"] = "";
        $route["args"] = array();

        //Fill out the $route array. If there are arguments, put them in the 'args' array, if there
        // is a method, put it in 'method', and if there is a controller, put it in 'controller' 
        if(count($pathParts) > 2)
        {
            $route["file"] = $pathParts[0];
            $route["controller"] = ucfirst($pathParts[0]) . "Controller";
            $route["method"] = $pathParts[1];
            
            for($i = 2; $i < count($pathParts); $i++)
            {
                array_push($route["args"], $pathParts[$i]);
            }
        }else{
            //If no path is specified, assing the default controller
            if(count($pathParts) == 0)
            {
                $route["controller"] = "default";
                $route["method"] = "index";
                array_push($route["args"],  null);
            }
            
            //If no method is specified, call the index() function on the given controller
            if(count($pathParts) == 1)
            {
                $route["file"] = $pathParts[0];
                $route["controller"] = ucfirst($pathParts[0]) . "Controller";
                $route["method"] = "index";
                array_push($route["args"],  null);            
            }

            //If no arguments are specefied, fill the args array with a null
            if(count($pathParts) ==  2)
            {
                $route["file"] = $pathParts[0];
                $route["controller"] = ucfirst($pathParts[0]) . "Controller";
                $route["method"] = $pathParts[1];
                array_push($route["args"],  null);            
            }
        }

        //If a controller file exists for this controller name, include it, otherwise call the 404 static method on the base controller class
        if(file_exists(BASEPATH . "App\\Controllers\\" . $route["file"] . ".php"))
        {
            include BASEPATH . "App\\Controllers\\" . $route["file"] . ".php";

            //If the method is a valid callable function, call it and pass any arguemtns. Otherwise call the base controller's 404 method
            if(is_callable($route['controller'] . "::" . $route['method']))
            {
                forward_static_call_array(array($route["controller"], $route['method']), $route["args"]);
            } else {
                Controller::Error404();
            }
        } else{

            Controller::Error404();
        }
    }
}