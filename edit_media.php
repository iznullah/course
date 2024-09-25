<?php
session_start();
require_once "conn.php";
require_once "functions.php";
$avatar = $_FILES['avatar']['tmp_name'];
$id= $_SESSION['user_id'];
$user=get_user_by_id($id);
upload_avatar($avatar,$user['email']);
    set_flash_message("success","Account updated successfully!!!");
    redirect_to('page_profile.php?id='.$id);