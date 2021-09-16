<?php 
//Uses questionID (from the client) 
// to delete a question from the question table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
<<<<<<< Updated upstream
    //star ID is saved in the session on login or signup.
    //if session exired on and not there return error. 
    $starID = 1; //$_POST["starID"]; Once frontend is done this can be uncommented
    //We are using ID from the questions table not questionNumber
    $questionID = $_POST["questionID"];
    $courseName = $_POST["courseName"];
=======
    $questionID = $_POST["questionID"];
>>>>>>> Stashed changes

    $conn = new mysqli("localhost:3306", $_SESSION["DBUN"], $_SESSION["DBPW"]);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
    }

    // prepare and bind
<<<<<<< Updated upstream
    $stmt = $conn->prepare("DELETE FROM mathtutor.questions AS QST WHERE ID = ? AND courseID = (SELECT ID FROM mathtutor.courses WHERE courseName = ?)");
    $stmt->bind_param("ii", $questionID, $courseName);
=======
    $stmt = $conn->prepare("DELETE FROM mathtutor.questions AS QST WHERE ID = ?");
    $stmt->bind_param("i", $questionID);
>>>>>>> Stashed changes

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
