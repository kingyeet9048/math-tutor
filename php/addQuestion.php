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
    //star ID is saved in the session on login or signup.
    //if session exired on and not there return error. 
    $starID = 1; //$_POST["starID"]; Once frontend is done this can be uncommented
    $courseName = $_POST["courseName"];
    $questionNumber = $_POST["questionNumber"];
    $questionType = $_POST["questionNumber"];
    $isOverride = empty($_POST["isOverride"]) ? null : $_POST["isOverride"] == 'true'; //optional
    $studentStarID = empty($_POST["studentStarID"]) ? null : $_POST["studentStarID"]; //optional

    $conn = new mysqli("localhost:3306", $_SESSION["DBUN"], $_SESSION["DBPW"]);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO mathtutor.questions(courseID, studentStarID, questionNumber, questionType, isOverride) VALUES ((SELECT ID FROM mathtutor.courses WHERE courseName = ?), ?, ?, ?, ?)");
    $stmt->bind_param("ssiib", $courseName, $studentStarID, $questionNumber, $questionType, $isOverride);

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