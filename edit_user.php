<?php

session_start();
require_once "conn.php";
require_once "functions.php";
$name = $_POST['name'];
$job = $_POST['job'];
$adress = $_POST['adress'];
$phone = $_POST['phone'];
$user_id=$_SESSION['user_id'];

$sql = "UPDATE users SET name=:name, job=:job, adress=:adress, phone=:phone WHERE id =:id";
$stmt = $conn->prepare($sql);
$stmt->execute(['name'=>$name,'job'=>$job,'adress'=>$adress,'phone'=>$phone,'id'=>$user_id]);
set_flash_message("success","Account updated successfully");
redirect_to("page_profile.php?id=$user_id");

