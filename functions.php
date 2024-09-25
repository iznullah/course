<?php

require_once "conn.php";
function set_flash_message($key,$message){
	$_SESSION['key']=$key;
	$_SESSION['message']=$message;
}
function display_flash_message(){
	if(isset($_SESSION['key'])){
		echo "<div class=\"alert alert-{$_SESSION['key']} text-dark\" role=\"alert\"> {$_SESSION['message']} </div>";

    unset($_SESSION['message']);
    unset($_SESSION['key']);
	}
}
function redirect_to($path){
	header("Location: {$path}");
	exit;
}
function get_user_by_email($email){
	
	$conn = new PDO("mysql:host=MySQL-5.7;dbname=myDBPDO",'root','');
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$check_exist = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check_exist->execute(['email' => $email]);
    $user = $check_exist->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function login($email, $password)
{
    $user = get_user_by_email($email);

    if (empty($user))
    {
        return false;
    }
    else
    {
        $check_pass = password_verify($password, $user['password']);
        if ($check_pass == true)
        {
            return $_SESSION['log-in'] = $user;
        }
        else
        {
            return false;
        }
    }
}
function is_login(){
	if(isset($_SESSION['log-in']) && !empty($_SESSION['log-in'])){
		return true;
	}
	return false;
}
function is_admin($email){
	$user = get_user_by_email($email);
	
	return $user['is_admin'];
}
function get_all_users(){
	$conn = new PDO("mysql:host=MySQL-5.7;dbname=myDBPDO",'root','');
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$all_users = $conn->prepare("SELECT * FROM users");
	$all_users->execute();
	$users = $all_users->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
function upload_avatar($avatar, $email)
{
     
        $to = 'uploaded/avatar_' . $email . '.png';
        move_uploaded_file($avatar, $to);

        $dsn = "mysql:host=MySQL-5.7; dbname=myDBPDO";
        $pdo = new PDO($dsn, 'root', '');

        $sql = "UPDATE users SET avatar=:avatar WHERE email =:email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['avatar' => $to,'email'=>$email]);
}

function get_user_by_id($id){
	$conn = new PDO("mysql:host=MySQL-5.7;dbname=myDBPDO",'root','');
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$check_exist = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $check_exist->execute(['id' => $id]);
    $user = $check_exist->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function has_avatar($id){
	$user=get_user_by_id($id);
	if($user['avatar']==null){
		return false;
	}
	else {
		return true;
	}
}

?>