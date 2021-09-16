<?php 
//Uses starID (from the session), 
// courseName (from the client), 
// to insert a course into the courses table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
<<<<<<< Updated upstream
    //star ID is saved in the session on login or signup.
    //if session exired on and not there return error. 
    $starID = 1; //$_POST["starID"]; Once frontend is done this can be uncommented
=======
    $starID = $_SESSION["USTARID"]; //Once frontend is done this can be uncommented
>>>>>>> Stashed changes
    $courseName = $_POST["courseName"];

    $conn = new mysqli("localhost:3306", $_SESSION["DBUN"], $_SESSION["DBPW"]);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
    }

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