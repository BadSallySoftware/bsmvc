<?php

class DatabaseConnection
{


    //Object Info
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


    public function error()
    {
        return $this->error;
    }


    public function createTable($tableName, $columns)
    {

        $this->connect();

        $sql = "CREATE TABLE " . $tableName ."( ";
        $count = count($columns);
        foreach($columns as $col => $type)
        {
            $sql .= $col . " " . $type;
            
            if($count > 1)
            {
                $sql .= ",";
            }
            $count--;
        }
        $sql .= ")";

        $this->connection->exec($sql);

        $this->disconnect();

       
       
    }

    public function query($sql)
    {
        $this->connect();

        try{
            $stmt = $this->connection->prepare($sql);
            
             $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e)
        {
            $this->error = $e->getMessage();
            return false;
        }

        $this->disconnect();
    }


    public function disconnect()
    {
        $this->statement = null;
        $this->connection = null;
        $this->database = null;
    }
}