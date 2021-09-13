<?php 
$email = $_POST["email"];
$password = $_POST["password"];

$conn = new mysqli("localhost:3306", "root", "root");

if ($conn->connect_error) {
    die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
}

session_start();

// if (isset($_SESSION))
// {
//     session_unset();
// } if we need to clear session cache on verification, this is the way to do it

$_SESSION["UEMAIL"] = $email; //store email and password in session variables
$_SESSION["UPASSWORD"] = $password;
$_SESSION["DBUN"] = "root";
$_SESSION["DBPW"] = "root";

// prepare and bind
$stmt = $conn->prepare("SELECT LGN.password AS 'password', INF.email AS 'email' from mathtutor.login AS LGN INNER JOIN mathtutor.info AS INF ON INF.email = ? AND LGN.password = ?");
$stmt->bind_param("ss", $email, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row != null) //login info found
{
    echo "success";
}
else //Login info found
{
    echo "failure";
}

?>