<?php
session_start();
require_once "conn.php";
require_once "functions.php";


$email = $_POST['email'];
$password = $_POST['password'];

$user=get_user_by_email($email);

if(!empty($user)){

	set_flash_message("danger","Этот эл. адрес уже занят другим пользователем.");
	redirect_to("page_register.php");
}

$sql = "INSERT INTO users(email,password) VALUES (:email,:password)";

$stmt = $conn->prepare($sql);
$stmt->execute(['email' => $email,'password' => password_hash($password, PASSWORD_DEFAULT)]);
set_flash_message("success","Регистрация прошла успешно");
redirect_to("login.php");