<?php
session_start();
require_once "conn.php";
require_once "functions.php";
$id= $_GET['id'];
$auth_user=$_SESSION['log-in'];
$user=get_user_by_id($id);
if(is_admin($auth_user['email']) or $auth_user['id']==$user['id']){
$sql = "DELETE from users WHERE id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id'=>$id]);
    if($auth_user['id']==$user['id']){
        session_destroy();
        redirect_to('page_register.php');}
    if(is_admin($auth_user['email'])){
    set_flash_message("success","Account deleted successfully!!!");
    redirect_to('users.php');}
}
