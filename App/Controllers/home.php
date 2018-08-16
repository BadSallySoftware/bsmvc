<?php

error_reporting(E_ALL);

class HomeController extends Controller
{
    
    public static function index()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {

           // $donations = json_decode(file_get_contents("https://extralife.donordrive.com/api/participants/301630/donations"));

           $donations = array();
            
             $file = fopen($_FILES['upload']['tmp_name'], "r");
            
             while(!feof($file))
             {
                 $lineArray = fgetcsv($file);
                $donation = array(
                    "name" => $lineArray[0],
                    "email" => $lineArray[1],
                    "datetime" => $lineArray[2],
                    "message" => $lineArray[3],
                    "amount" => $lineArray[4]
                );
                array_push($donations,$donation);
            }
              

             // for($i = 0; $i < 4; ++$i)
            // {
            //     $line = fgets($file);
            // }
            // while($line = fgets($file))
            // {
            //     $lineArray = explode(",", $line);
            
                
        

            include BASEPATH . "App\\Models\\donations.php";
            // echo "<pre>";
            // var_dump($donations);
            // echo "</pre>";
            // die;
            $donModel = new DonationsModel();

            if(!$donModel->updateDonations($donations))
            {
                echo $donModel->error();
            }

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

