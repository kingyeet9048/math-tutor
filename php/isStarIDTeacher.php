<?php 
session_start();
include("helper/connectToDB.php");
$conn = connectToDB();
$starID = $_SESSION["USTARID"];

$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);
$returnState = new stdClass();

if(!isset($decodedData->starID))
{
    $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
}
else
{
    //getting the raw sha256 output
    $starID = $decodedData->starID;
    if(!isset($starID))
    {
        $starID = $_SESSION["USTARID"];
    }
    
    if($starID != null)
    {
        echo $starID;
        // prepare and bind
        $stmt = $conn->prepare("SELECT TCH.teacherStarID FROM mathtutor.teacherinfo AS INF WHERE INF.teacherStarID = ?;");
        $stmt->bind_param("s", $starID);
    
        //execute and receive query results
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $returnState -> $row != null;
    
        $stmt->close();
        $conn->close();
    }
    else
    {
        $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
    }
}

echo json_encode($returnState);

?>