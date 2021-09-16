<?php 
//Uses starID (from the session), 
// courseName (from the client), 
// and questionID (from the client) 
// to delete a question from the question table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
    $starID = 1; //$_POST["starID"]; Once frontend is done this can be uncommented
    $questionNumber = $_POST["questionNumber"];
    $courseName = $_POST["courseName"];

    $conn = new mysqli("localhost:3306", $_SESSION["DBUN"], $_SESSION["DBPW"]);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
    }

    // prepare and bind
    $stmt = $conn->prepare("");
    $stmt->bind_param("i", $questionNumber);

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