<?php
include  $_SERVER['DOCUMENT_ROOT'] .'/core/load.php';
include $_SERVER['DOCUMENT_ROOT'] . '/connect/Login.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$userId = Login::isLogginedIn();
if(isset($_POST['editedText'])){
    $editedText = $_POST['editedText'];
    $userId = $_POST['userid'];
    $postId = $_POST['postid'];
    $loadFromPost->postUpd($userId,$postId,$editedText);
}