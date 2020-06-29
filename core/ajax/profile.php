<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/load.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/connect/Login.php';
$userId = Login::isLogginedIn();
echo $_POST['name'];
