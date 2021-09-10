<?php 
$username = $_POST["username"];
$password = $_POST["password"];

$conn = new mysqli("localhost:3306", "root", "root");

if ($conn->connect_error) {
    die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
}

// prepare and bind
$stmt = $conn->prepare("SELECT LGN.password AS 'password', INF.email AS 'email' from mathtutor.login AS LGN INNER JOIN mathtutor.info AS INF ON INF.email = ? AND LGN.password = ?");
$stmt->bind_param("ss", $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row != null) //No login info found
{
    echo "success";
}
else //Login info found
{
    echo "failure";
}

?>
