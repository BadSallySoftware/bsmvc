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
    
    public function updateDonations($donations)
    {
        $this->connect();

        try{
            $sql = "TRUNCATE donations";
            $this->connection->exec($sql);

            $sql = "INSERT INTO donations(name, email, datetime, message, amount) VALUES";
            foreach($donations as $donation)
            {
                $sql .= "('" . $str = addslashes($donation['name']) . "' , '" . 
                addslashes($donation['email']) . "' , '" . 
                addslashes($donation['datetime']) . "' , '" . 
                addslashes($donation['message']) . "' , '" . 
                $donation['amount'] . "'),";
            }

            $sql = rtrim($sql, ',');
            $sql .= ";";

    
            //$stmt = $this->connection->prepare($sql);
            
             $this->connection->exec($sql);
            return true;
        }catch(PDOException $e)
        {
            $this->error = $e->getMessage();
            return false;
        }

        $this->disconnect();
    }
}