<?php 
session_start();
include("helper/connectToDB.php");
$conn = connectToDB();
$starID = $_SESSION["USTARID"];


$returnState = new stdClass();

if(!isset($_SESSION) && !isset($decodedData->starID))
{
    $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
}
else
{
    //getting the raw sha256 output
    $starID = $_SESSION["USTARID"];
    if(!isset($starID))
    {
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);
        $starID = $decodedData->starID;
    }
    
    if($starID != null)
    {
        // prepare and bind
        $stmt = $conn->prepare("SELECT TCH.teacherStarID AS 'starID' FROM mathtutor.teacherinfo AS TCH WHERE TCH.teacherStarID = ?;");
        $stmt->bind_param("s", $starID);
    
        //execute and receive query results
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $returnState -> isTeacher = !empty($row);
        $returnState->success = true;
    
        $stmt->close();
        $conn->close();
    }
    else
    {
        $returnState->success = false;
        $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
    }
}

echo json_encode($returnState);

?>