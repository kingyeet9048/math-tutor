<?php 

include("connectToDB.php");
$conn = connectToDB();
$starID = $_POST["starID"];

// prepare and bind
$stmt = $conn->prepare("SELECT INF.role FROM mathtutor.info WHERE INF.starID = ?;");
$stmt->bind_param("s", $starID);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row == null)
{
    echo "failure|null";
}
else
{
    if($row["role"] === "teacher")
    {
        echo "success|true";
    }
    else
    {
        echo "failure|false";
    }
}

$stmt->close();
$conn->close();

?>