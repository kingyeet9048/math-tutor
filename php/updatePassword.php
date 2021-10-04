<?php 
//Uses courseName (from the client) 
// to delete a course's references from courses, questions, records and students tables

session_start();
$returnState = new stdClass();

if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $role = $decodedData->role;
    $starID = $decodedData->starID;
    $newPW = $decodedData->newPassword;
    include("helper/connectToDB.php");
    $conn = connectToDB();

    if($role == "teacher")
    {
        // prepare and bind
        $stmt = $conn->prepare("CALL mathtutor.forgotPasswordTeacher(?,?);");
    }
    else
    {
        // prepare and bind
        $stmt = $conn->prepare("CALL mathtutor.forgotPasswordStudent(?,?);");
    }

    $stmt->bind_param("s", $starID, $newPW);

    //execute and receive query results
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
else
{
    $returnState -> error = "Please validate the database connection variables before proceeding.";
}

$returnState -> success = isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]) && isset($_SESSION["DBLC"]);
echo json_encode($returnState);

?>
