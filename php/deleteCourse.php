<?php 
//Uses courseName (from the client) 
// to delete a course's references from courses, questions, records and students tables

session_start();
$returnState = new stdClass();

if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $courseName = $decodedData->courseName;
    include("helper/connectToDB.php");
    $conn = connectToDB();

    // prepare and bind
    $stmt = $conn->prepare("CALL mathtutor.deleteCourse(?);");
    $stmt->bind_param("s", $courseName);

    //execute and receive query results
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
else
{
    $returnState->error = "No database session variables found. Try setting them first.";
}

$returnState -> success = isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]) && isset($_SESSION["DBLC"]);
echo json_encode($returnState);

?>
