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
    $starID = $_SESSION["USTARID"]; //$_POST["starID"]; Once frontend is done this can be uncommented
    $courseName = $_POST["courseName"];
    $questionNumber = $_POST["questionNumber"];
    $questionType = $_POST["questionType"];
    $isOverride = empty($_POST["isOverride"]) ? 0 : $_POST["isOverride"] == 'true'; //optional
    $studentStarID = empty($_POST["studentStarID"]) ? null : $_POST["studentStarID"]; //optional

    include("connectToDB.php");
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
