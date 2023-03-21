<?php
$host = "localhost";
$dbname = "uptask";
$username = "root";
$password = "root";

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
  echo $conn->connect_error;
}

$conn->set_charset('utf8');
?>