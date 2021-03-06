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
    public function userIdByUserName($username){
        $stmt = $this->pdo->prepare('SELECT user_id FROM users WHERE userLink = :username');
        $stmt->bindParam(':username',$username,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user->user_id;
    }
    public function userData($profileId){
        $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.user_id WHERE users.user_id = :user_id");
        $stmt->bindParam(':user_id',$profileId,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($table,$user_id,$fields = array()){
        $column = '';
        $i = 1;
        foreach ($fields as $name=>$value) {
            $column .="{$name} = :{$name}";
            if($i < count($fields)){
                $column .=', ';
            }
            $i++;
        }
        $sql = "UPDATE {$table} SET {$column} WHERE user_id= {$user_id}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($fields);
    }
    public function timeAgo($datatime){
        $time = strtotime($datatime);
        $current = time();
        $seconds = $current-$time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600);
        $months = round($seconds / 2600640);
        if($seconds <= 60){
            if($seconds == 0){
                return 'posted now';
            }else{
                return $seconds . 's ago';
            }
        }else if($minutes <= 60){
            return $minutes . 'm ago';
        }else if($hours <= 24){
            return $hours.' h ago';
        }else if($months <= 24){
            return date('M j' ,$time);
        }else{
            return date('j M Y',$time);
        }
    }
}