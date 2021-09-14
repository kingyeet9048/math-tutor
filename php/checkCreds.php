<?php 
//Verifies the email and password inputted with the database.
//Takes input named 'email' and 'password'
// 
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    echo $_SESSION["DBUN"].",".$_SESSION["DBPW"].",".$_SESSION["DBLC"]."<br>";
    $conn = new mysqli($_SESSION["DBLC"], $_SESSION["DBUN"], $_SESSION["DBPW"]);
}
else
{
    echo "no session";
    $conn = new mysqli("localhost:3306", "root", "root");
}

if ($conn->connect_error) {
    die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
}

session_start();

$_SESSION["UEMAIL"] = $email; //store email and password in session variables
$_SESSION["UPASSWORD"] = $password;

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