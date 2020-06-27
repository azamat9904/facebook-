<?php
class User{
    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function checkInput($str){
        $str = htmlspecialchars($str);
        $str = trim($str);
        $str = stripslashes($str);
        return $str;
    }
    public function checkEmail($email){
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0) return true;
        else return false;
    }
    public function create($table,$fields = array()){
        $column = implode(',',array_keys($fields));
        $values = ':'.implode(', :',array_keys($fields));
        $sql = "INSERT INTO $table ($column) VALUES ($values)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($fields);
        return $this->pdo->lastInsertId();
    }
}