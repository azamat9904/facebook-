<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/load.php';
include $_SERVER['DOCUMENT_ROOT'].'/connect/Login.php';
$_POST = json_decode(file_get_contents("php://input"), true);
$userId = Login::isLogginedIn();

if(isset($_POST['text'])){
    $statusText = $_POST['text'];
}

if(isset($_POST['names']) && count($_POST['names']) !== 0){
    $names = $_POST['names'];
    $str = '[';
    foreach($names as $key=>$value){
        $str .= "{\"imageName\":\"users/$userId/postImage/$value\"},";
    }
    $str = substr($str,0,-1);
    $str .= ']';
    $loadFromUser->create('post',array('user_id'=>$userId,'post'=>$statusText,'postImage'=>$str,'postBy'=>$userId,'postedOn'=>date('Y-m-d H:i:s')));
}else {
    if(isset($_POST['text']) && !empty($_POST['text'])){
        $loadFromUser->create('post',array('user_id'=>$userId,'post'=>$statusText,'postBy'=>$userId,'postedOn'=>date('Y-m-d H:i:s')));
    }
}