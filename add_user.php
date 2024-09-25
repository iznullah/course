<?php

session_start();
require_once "conn.php";
require_once "functions.php";
try{
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$job = $_POST['job'];
$adress = $_POST['adress'];
$phone = $_POST['phone'];
$status = $_POST['status'];
$avatar = $_FILES['avatar']['tmp_name'];
$vk = $_POST['social_vk'];
$tg = $_POST['social_telegram'];
$ins = $_POST['social_instagram'];
$check_exist = get_user_by_email($email);
if (!empty($check_exist)) {
   
    set_flash_message("danger","This email is already registered");
    redirect_to("create_user.php");

}
else {
$sql = 'INSERT INTO users(name, surname, job, phone, adress, email, password, status, social_vk, social_telegram, social_instagram) 
VALUES   (:name, :surname, :job, :phone, :adress, :email, :password, :status, :social_vk, :social_telegram, :social_instagram)';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $name,'surname' => $surname,'job' => $job, 'phone' => $phone, 'adress' => $adress, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'status' => $status, 'social_vk' => $vk, 'social_telegram' => $tg, 'social_instagram' => $ins]);
    upload_avatar($avatar, $email);
    set_flash_message("success","New account added");
    redirect_to("users.php");
    
}
}

catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
