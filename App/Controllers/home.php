<?php

error_reporting(E_ALL);

class HomeController extends Controller
{
    
    public static function index()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            // echo "<pre>";
            // var_dump($_FILES);
            // echo "</pre>";
            $donations = array();
            $file = fopen($_FILES['upload']['tmp_name'], "r");
            while($line = fgets($file))
            {
                $lineArray = explode(",", $line);
                array_push($donations,$lineArray);
            }
             
            $data = str_getcsv($raw, ',');
                        echo "<pre>";
            var_dump($donations);
            echo "</pre>";
        }
        global $db;
        $result = $db->query("SELECT * FROM `testtable`");

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

