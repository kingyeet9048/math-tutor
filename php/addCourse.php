<?php 
//Uses starID (from the session), 
// courseName (from the client), 
// to insert a course into the courses table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{

    $starID = $_SESSION["USTARID"]; //Once frontend is done this can be uncommented
    $courseName = $_POST["courseName"];

    include("connectToDB.php");
    $conn = connectToDB();

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO mathtutor.courses(courseName, starID) VALUES (?, ?)");
    $stmt->bind_param("ss", $courseName, $starID);

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
