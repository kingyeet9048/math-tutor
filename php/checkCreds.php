<?php 
//Verifies the email and password inputted with the database.
//Takes input named 'email' and 'password'
// 
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();

$username = $_POST["username"];
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

$_SESSION["UEMAIL"] = $username; //store email and password in session variables
$_SESSION["UPASSWORD"] = $password;

// prepare and bind
$stmt = $conn->prepare("SELECT LGN.password AS 'password', LGN.password AS 'password', LGN.starID AS 'starID' FROM mathtutor.login AS LGN WHERE LGN.username = ? AND LGN.password = ?");
$stmt->bind_param("ss", $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row != null) //login info found
{
    $_SESSION["USTARID"] = $row["starID"];
    echo "success";
}
else //Login info found
{
    echo "failure";
}

$stmt->close();
$conn->close();

?>
