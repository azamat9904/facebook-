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
    public function update($table,$data){
        $column1 = array_keys($data)[0];
        $column2 = array_keys($data)[1];
        $value1 = $data[$column1];
        $value2 = $data[$column2];
        $sql = "UPDATE $table SET $column1 = '$value1' WHERE $column2 = $value2";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    public function userIdByUserName($username){
        $stmt = $this->pdo->prepare('SELECT user_id FROM users WHERE userLink = :username');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user->user_id;
    }

}