<?php 
//Verifies the username and password inputted with the database credentials.
//Takes input named 'username' and 'password'
// 
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();
$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);
//getting the raw sha256 output
$username = $decodedData->username;
$password = $decodedData->password;

include("helper/connectToDB.php");
$conn = connectToDB();

$_SESSION["USERNAME"] = $username; //store username and password in session variables
$_SESSION["UPASSWORD"] = $password;

$returnState = new stdClass();
$returnState->success = false;
// prepare and bind
$stmt = $conn->prepare("SELECT TCH.teacherStarID AS 'starID' FROM mathtutor.teacherinfo AS TCH WHERE (TCH.userName = ? AND TCH.password = ?) LIMIT 1");
$stmt->bind_param("ss", $username, $password);
//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(isset($row["starID"]) && $row["starID"] != null)
{
    $_SESSION["USTARID"] = $row["starID"];
    $returnState->success = true;
}
else{
    $returnState->success = false;
}

$stmt->close();
$conn->close();

echo json_encode($returnState);

?>
