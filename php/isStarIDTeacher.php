<?php 

include("helper/connectToDB.php");
$conn = connectToDB();
$starID = $_SESSION["USTARID"];

if(isset($_POST) && isset($_POST["starID"]))
{
    $starID = $_POST["starID"];
}

// prepare and bind
$stmt = $conn->prepare("SELECT TCH.teacherStarID FROM mathtutor.teacherinfo AS INF WHERE INF.teacherStarID = ?;");
$stmt->bind_param("s", $starID);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$returnState -> $row != null;

echo json_encode($returnState);

$stmt->close();
$conn->close();

?>