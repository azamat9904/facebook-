<?php

class DB{
    private static function connect(){
        $pdo = new PDO('mysql:host=localhost;dbname=facebook;charset=utf8mb4','root','');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    public static function query($query, $params=[]){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if(explode(' ',$query)[0] == 'SELECT'){
            return $statement->fetchAll();
        }
    }
}