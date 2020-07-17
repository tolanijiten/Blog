<?php
/**
 * Created by PhpStorm.
 * User: Nikhil Ghind
 * Date: 29-01-2019
 * Time: 07:42 PM
 */

class Categories{

    private $table = "categories";

    private $category_id;
    private $category_name;
    private $category_status;
    private $conn;

    /**
     * Categories constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function createCategory($data){
        $columnString = implode(", ",array_keys($data));
        $valueString = ":".implode(", :",array_keys($data));
        $sql = "INSERT INTO {$this->table} ({$columnString}) VALUES ({$valueString})";
//        echo $sql;
        $ps = $this->conn->prepare($sql);

        $result = $ps->execute($data);

        if($result){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }
    }

    public function getCategoryName($category_id){
        
    }

    public function  updateCategory($data,$condition){
        $i=0;
        $columnValueset  = "";
        foreach($data as $key=>$value){
            $comma = ($i<count($data)-1?", ":"");
            $columnValueset.=$key."='".$value."'".$comma;
            $i++;
        }

        $sql = "UPDATE $this->table SET $columnValueset WHERE $condition";
        $ps = $this->conn->prepare($sql);

        $result = $ps->execute();

        if($result){
            return $ps->rowCount();
        }else{
            return false;
        }
    }


    function readAllCategories(){
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function readAllActiveCategories(){
        $sql = "SELECT * FROM {$this->table} WHERE category_status = 'active'";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }


}