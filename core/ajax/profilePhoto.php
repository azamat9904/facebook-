<?php

require_once  $_SERVER['DOCUMENT_ROOT'].'/core/load.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/connect/Login.php';
$user_id = Login::isLogginedIn();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['file'])){
        if(0 <= $_FILES['file']['error']){
            $name = $loadFromUser->checkInput('users/'.$user_id .'/profilePhoto/'.$_FILES['file']['name']);
            $loadFromUser->update('profile',$user_id,array('profilePic'=>$name));
            $dirname = $_SERVER['DOCUMENT_ROOT'].'/users/'.$user_id .'/profilePhoto/';
            if(!file_exists($dirname) && !is_dir($dirname)){
                mkdir($dirname,0777,true);
            }
            move_uploaded_file($_FILES['file']['tmp_name'],$dirname.$_FILES['file']['name']);
            echo $name;
        }
    }
}
