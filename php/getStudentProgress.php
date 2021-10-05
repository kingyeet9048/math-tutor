<?php 
//Uses courseName (from the client) 
// to delete a course's references from courses, questions, records and students tables

session_start();
$returnState = new stdClass();

if(isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);

    include("helper/connectToDB.php");
    $conn = connectToDB();
    
    if(isset($_SESSION))
    {
        $starID = $_SESSION["USTARID"];
    }

    if(!isset($starID))
    {
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);
        $starID = $decodedData->starID;
    }

    // prepare and bind
    $stmt = $conn->prepare("CALL mathtutor.getStudentProgress(?);");
    $stmt->bind_param("s", $starID);

    //execute and receive query results
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $returnState->success = !empty($row);

    if($returnState->success)
    {
        $returnState->progress = $row["@percentComplete"];
    }
    else
    {
        $returnState->progress = 0;
    }

    $stmt->close();
    $conn->close();
}
else
{
    $returnState->error = "No database session variables found. Try setting them first.";
    $returnState->success = false;
}

echo json_encode($returnState);

?>
