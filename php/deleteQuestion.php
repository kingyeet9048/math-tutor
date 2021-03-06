<?php 
//Uses questionID (from the client) 
// to delete a question from the question table

session_start();
$returnState = new stdClass();

if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $questionID = $decodedData->questionID;
    include("helper/connectToDB.php");
    $conn = connectToDB();

    // prepare and bind
    $stmt = $conn->prepare("DELETE FROM mathtutor.questions WHERE questionID = ?");
    $stmt->bind_param("i", $questionID);

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
