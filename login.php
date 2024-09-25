<?php

session_start();
require_once "conn.php";
require_once "functions.php";
$email = $_POST['email'];
$password = $_POST['password'];
$auth=login($email,$password);
if(!$auth){
	//set_flash_message("danger","Email or password is not valid.");
	redirect_to("page_login.php");
}
else{
	set_flash_message("success","Welcome ".$auth['name']);
	redirect_to("users.php");
}

?>