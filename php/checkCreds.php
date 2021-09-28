<html>
    <form method="post">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit">
    </form>
</html>

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
$username = $_POST["username"];
$password = $_POST["password"];

include("helper/connectToDB.php");
$conn = connectToDB();

$_SESSION["USERNAME"] = $username; //store username and password in session variables
$_SESSION["UPASSWORD"] = $password;

// prepare and bind
$stmt = $conn->prepare("SELECT STU.studentStarID AS 'studentStarID', TCH.teacherStarID AS 'starID' FROM mathtutor.teacherinfo AS TCH INNER JOIN mathtutor.studentinfo AS STU ON (TCH.username = ? AND TCH.password = ?) OR (STU.username = ? AND STU.password = ?)");
$stmt->bind_param("ssss", $username, $password, $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$returnState = new stdClass();
$returnState->success = false;

if($row != null) //login info found
{
    $_SESSION["USTARID"] = $row["starID"];
    $returnState->success = true;
}

$stmt->close();
$conn->close();

echo json_encode($returnState);

?>
