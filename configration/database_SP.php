<?php

class database{

    private $db_name = "sp";
    private $db_username = "root";
    private $db_password = "bruhbruh";
    private $db_host = "localhost";
    public $connection;

    public function connect(){
        try{
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_username , $this->db_password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }

            catch(PDOException $e){
                echo "connection error: ". $e->getMessage();
            }

    return $this->connection;
    }
}