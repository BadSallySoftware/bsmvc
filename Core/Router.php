<?php

class Router{

    private $requestPath;

    public function __contstruct($path)
    {
        $this->requestPath = $path;
        
    }

    public function findControllerFunction()
    {
        
        include BASEURL . "App\\Config\\routes.php";
        $pathParts = explode("/", $this->requestPath);
        
        

        
        if(count($pathParts) < 1)
        {
            $route["name"] = "default";
            $route["method"] = "index";
            $route["args"] = null;
        }
        
        if(count($pathParts < 2))
        {
            $route["name"] = $pathParts[0];
            $route["method"] = "index";
            $route["args"] = null;
        }

        return $pathParts
    }
}