<?php
    include 'database/connection.php';
    include 'classes/User.php';
    include 'classes/Post.php';
    include 'connect/DB.php';

    global $pdo;

    $loadFromUser = new User($pdo);
    $loadFromPost = new Post($pdo);
    define('BASE_URL','http://localhost/facebook');

