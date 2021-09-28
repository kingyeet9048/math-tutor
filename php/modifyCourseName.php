<?php 

session_start();
$returnState = new stdClass();

if(isset($_SESSION["DBCONNECTION"]))
{

    $starID = $_SESSION["USTARID"];
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $username = $decodedData->courseName;

    include("connectToDB.php");
    $conn = connectToDB();

    $stmt = $conn->prepare("UPDATE mathtutor.courses SET courseName = ? WHERE teacherStarID = ?");
    $stmt->bind_param("ss", $courseName, $starID);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    $returnState -> success = true;
}
else
{
    $returnState -> success = false;
}

echo json_encode($returnState);
?>
