<?php
class DB{
    private $dbtype="mysql";
    private $host="localhost";
    private $dbname="res";
    private $user="root";
    private $password="";
    private $pdo;
    public function __construct()
    {
        $this->pdo=new PDO("$this->dbtype:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
    }
    public function _get(){
        return $this->pdo;
    }
    public function insert($table,$cols,$values){
        return $this->pdo->query("insert into $table ($cols) values ($values)");
    }
    public function select($cols,$table,$condition=1){
        return $this->pdo->query("SELECT $cols From $table where $condition");
    }
    public function delete($table,$condition){
        return $this->pdo->query("DELETE FROM $table where $condition");
    }
    public function edit($table,$cols,$condition){
        return $this->pdo->query("UPDATE $table SET $cols where $condition");
    }


}