<?php
class Database{
    private $host = "localhost";
    private $db_name = "oop_blog";
    private $username = "JITEN";
    private $password = "qwertyuiop";
    private $conn = null;
    
    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}",$this->username,$this->password);
//            echo "Connected";
        }catch(PDOException $e){
            die("Issue : ".$e->getMessage());
        }
    }
    
    public function getConnection(){
        return $this->conn;
    }
}
?>