<?php 
//Uses questionID (from the client) 
// to delete a question from the question table

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
    $questionID = $_POST["questionID"];
    include("connectToDB.php");
    $conn = connectToDB();

    // prepare and bind
    $stmt = $conn->prepare("DELETE FROM mathtutor.questions AS QST WHERE ID = ?");
    $stmt->bind_param("i", $questionID);

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
