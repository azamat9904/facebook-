<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/load.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/connect/Login.php';
$userId = Login::isLogginedIn();
$_POST = json_decode(file_get_contents("php://input"), true);
if($_POST){
    $name = 'users/'.$userId.'/coverphoto/'. $loadFromUser->checkInput($_POST['name']);
    $size = $loadFromUser->checkInput($_POST['size']);
    $type = $loadFromUser->checkInput($_POST['type']);
    $loadFromUser->update('profile',$userId,array('coverPic'=>$name));
}

if(0 < $_FILES['file']['error']){
    echo "Error: " . $_FILES['file']['error']."<br/>";
}else{
    $path_directory = $_SERVER['DOCUMENT_ROOT'].'/users/'.$userId."/coverphoto/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
        mkdir($path_directory,0777,true);
    }
    move_uploaded_file($_FILES['file']['tmp_name'],$path_directory.$_FILES['file']['name']);
    $name = $_FILES['file']['name'];
    echo 'users/'.$userId.'/coverphoto/'.$name;
}

