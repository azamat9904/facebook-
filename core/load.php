<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/core/database/connection.php';
    require_once  $_SERVER['DOCUMENT_ROOT'].'/core/classes/User.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/core/classes/Post.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/connect/DB.php';
    global $pdo;

    $loadFromUser = new User($pdo);
    $loadFromPost = new Post($pdo);
    define('BASE_URL','http://localhost/facebook');

