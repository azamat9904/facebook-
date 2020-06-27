<?php
$hostDetail = "mysql:host=localhost;dbname=facebook;charset=utf8mb4;";
$userName = "root";
$password = "";
try{
    $pdo = new PDO($hostDetail,$userName,$password);
}catch(PDOException $e){
    echo "Error occured " . $e->getMessage();
}
