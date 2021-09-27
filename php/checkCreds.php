<?php 
//Verifies the username and password inputted with the database credentials.
//Takes input named 'username' and 'password'
// 
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();

// $username = $_POST["username"];
// $password = $_POST["password"];

$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);
//getting the raw sha256 output
$username = $decodedData->username;
$password = $decodedData->password;

include("connectToDB.php");
$conn = connectToDB();

$_SESSION["USERNAME"] = $username; //store username and password in session variables
$_SESSION["UPASSWORD"] = $password;

// prepare and bind
$stmt = $conn->prepare("call mathtutor.signin(?, ?);");
$stmt->bind_param("ss", $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row['starID'] != null) //login info found
{
    $_SESSION["USTARID"] = $row["starID"];
    echo "success|true";
}
else //Login info found
{
    echo "failure|false";
}

$stmt->close();
$conn->close();

?>
