<?php
session_start();
require_once "conn.php";
require_once "functions.php";
$email = $_POST['email'];
$password = $_POST['password'];
$password_conf = $_POST['password_conf'];
$id= $_SESSION['user_data']['id'];
$user=get_user_by_email($email);
if ($password!=$password_conf) {
    set_flash_message("danger","Пароль не совпадает.");
    redirect_to("security.php?id=".$id);
}

if($email==$_SESSION['user_data']['email'] or empty($user)){
    $sql = "UPDATE users SET email=:email, password=:password WHERE id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email'=>$email,'password'=>password_hash($password, PASSWORD_DEFAULT),'id'=>$id]);
    set_flash_message("success","Account updated successfully");
    redirect_to("page_profile.php?id=".$id);
}

else
{

    set_flash_message("danger","Этот эл. адрес уже занят другим пользователем.");
    redirect_to("security.php?id=".$id);
}


