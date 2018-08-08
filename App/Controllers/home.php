<?php

error_reporting(E_ALL);

class HomeController extends Controller
{
    
    public function index()
    {
        $list = array( 
            'things' => array(
                "thing1",
                "thing2",
                "thing3"
            ),
            'title' => "Home title"
        );

        $this->render("home", $list);
    }
}

