<?php

error_reporting(E_ALL);

class HomeController extends Controller
{
    
    public static function index()
    {
        $list = array( 
            'things' => array(
                "thing1",
                "thing2",
                "thing3"
            ),
            'title' => "Home title"
        );

        Parent::render("home", $list);
    }
}

