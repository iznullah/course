<?php
session_start();
require_once "conn.php";
require_once "functions.php";
$status = $_POST['status'];
$id= $_SESSION['user_id'];
$user_id=$_SESSION['user_id'];
$user=get_user_by_id($id);
$sql = "UPDATE users SET status=:status WHERE id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['status'=>$status,'id'=>$id]);
    set_flash_message("success","Account updated successfully!!!");
    redirect_to('page_profile.php?id='.$id);