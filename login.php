<?php 
$email = $_POST["email"];
$password = $_POST["password"];

$conn = new mysqli("localhost:3306", "root", "root");

if ($conn->connect_error) {
    die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
}

echo $email." ".$password;
?>