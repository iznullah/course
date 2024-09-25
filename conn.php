 <?php

$servername = "MySQL-5.7";
$username = "root";
$password = "";

 $conn = new PDO("mysql:host=$servername;dbname=myDBPDO",$username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);