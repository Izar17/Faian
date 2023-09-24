<?php 

session_start();

require_once 'db_connect.php';


if(!$_SESSION['userId']) {
	header('location:'.$store_url);	
} 
date_default_timezone_set('Asia/Bangkok');
$curDate = date("m/d/Y"); 
$curTime = date("H:i:s");
$user_id = $_SESSION['userId'];



?>