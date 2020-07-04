<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/load.php';
include $_SERVER['DOCUMENT_ROOT'].'/connect/Login.php';

$userId = Login::isLogginedIn();
if($_FILES['files']['error'] >= 0){
    for($count = 0;$count <count($_FILES['files']['name']);$count++){
        $file_name = $_FILES['files']['name'][$count];
        $tmp_name = $_FILES['files']['tmp_name'][$count];
        $path_directory = $_SERVER['DOCUMENT_ROOT'].'/users/'.$userId.'/postImage/';
        if(!file_exists($path_directory) && !is_dir($path_directory)){
            mkdir($path_directory,077,true);
        }
        echo $path_directory;
        move_uploaded_file($tmp_name,$path_directory.$file_name);
    }
}
