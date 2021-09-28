<?php 
//Uses starID (from the session), 
// courseName (from the client), 
// questionNumber (from the client),
// questionType (from the client),
// isOverride (optional from client)
// studentStarID (optional from client)
// to insert a question into the question table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
    $starID = $_SESSION["USTARID"];
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $courseName = $decodedData->courseName;
    $questionNumber = $decodedData->questionNumber;
    $questionType = $decodedData->questionType;
    $isOverride = $decodedData->isOverride;
    $studentStarID = $decodedData->studentStarID;

    include("helper/connectToDB.php");
    $conn = connectToDB();
    
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO mathtutor.questions(courseID, starID, questionNumber, questionType, isOverride) VALUES ((SELECT ID FROM mathtutor.courses WHERE courseName = ?), ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $courseName, $studentStarID, $questionNumber, $questionType, intval($isOverride));

    //execute and receive query results
    $stmt->execute();

    $stmt->close();
    $conn->close();

    //
    echo "success|";
}
else
{
    echo "failure|";
}

?>
