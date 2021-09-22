<?php 

session_start();

if(isset($_SESSION["DBCONNECTION"]))
{

    $starID = $_SESSION["USTARID"];
    $courseName = $_POST["courseName"];

    include("connectToDB.php");
    $conn = connectToDB();

    $stmt = $conn->prepare("UPDATE mathtutor.courses SET courseName = ? WHERE teacherStarID = ?");
    $stmt->bind_param("ss", $courseName, $starID);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "success|";
}
else
{
    echo "failure|";
}

?>
