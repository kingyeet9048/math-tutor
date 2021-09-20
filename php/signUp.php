<?php 
//Takes the credentials given and inserts it into the database.
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();

$username = $_POST["username"];
$password = $_POST["password"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$role = $_POST["role"];

include("connectToDB.php");
$conn = connectToDB();

$_SESSION["UEMAIL"] = null; //wipe username and password from session variables
$_SESSION["UPASSWORD"] = null;

include("genUniqueID.php");
$starID = genUniqueStarId();

// prepare and bind
$stmt = $conn->prepare("INSERT INTO mathtutor.login(starID,userName,password) VALUES (?,?,?);");
$stmt->bind_param("sss", $starID, $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row == null)
{
    echo "failure|null";
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO mathtutor.info(starID,lastName,firstName,role) VALUES (?,?,?,?);");
$stmt->bind_param("ssss", $starID, $firstName, $lastName, $role);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row != null) //login info succeeded
{
    $_SESSION["USTARID"] = $row["starID"];
    echo "success|";
}
else //Login info failed
{
    echo "failure|";
}

$stmt->close();
$conn->close();

?>
