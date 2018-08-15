<?php


class DonationsModel{


    private $error;
    private $connection;

    public function connect()
    {
        include BASEPATH . "App\\Config\\dbConfig.php";
        $connString = 'mysql:host=' . $dbHost . ';dbname=' . $dbName;

        try
        {
            $this->connection = new PDO($connString, $dbUser, $dbPassword);
            return true;
        }
        catch(PDOException $e)
        {
            $this->error = $e->getMesage();        
            return false;
        }
    }

}