<?php 
//Uses starID (from the session), 
// courseName (from the client), 
// to insert a course into the courses table

session_start();
$returnState = new stdClass();

if(isset($_SESSION["DBCONNECTION"]))
{

    $starID = $_SESSION["USTARID"]; //Once frontend is done this can be uncommented
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $courseName = $decodedData->courseName;

    include("helper/connectToDB.php");
    $conn = connectToDB();

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO mathtutor.courses(courseName, starID) VALUES (?, ?)");
    $stmt->bind_param("ss", $courseName, $starID);

    //execute and receive query results
    $stmt->execute();

    $stmt->close();
    $conn->close();
    //
    $returnState->success = true;
}
else
{
    $returnState->success = true;
}

echo json_encode($returnState);

?>
