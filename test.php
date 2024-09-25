<?php

session_start();
require_once "conn.php";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
} 
$email = "asdw";
try{
	$stmt = $conn->prepare("select count(*) from users where email = '$email'");
	$stmt->execute();

	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo "$v <br>";
  }

}

	catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}