<?php 

session_start();
$returnState = new stdClass();

if(isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
{
    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $courseName = $decodedData->courseName;
    include("helper/connectToDB.php");
    $conn = connectToDB();
    
    if(isset($_SESSION))
    {
        $starID = $_SESSION["USTARID"];
    }

    if(!isset($starID))
    {
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);
        $starID = $decodedData->starID;
    }
    // prepare and bind
    $stmt = $conn->prepare("CALL mathtutor.getEnrolled(?);");
    $stmt->bind_param("s", $starID);
    //execute and receive query results
    $stmt->execute();
    $result = $stmt->get_result();
    $returnState->students = array();

    while($row = mysqli_fetch_assoc($result)) {
        if(!empty($row))
        {
            $stu = new stdClass();
            $stu->firstName = $row["firstName"];
            $stu->lastName = $row["lastName"];
            $stu->numComplete = $row["COUNT(*)"];
            array_push($returnState->students,$stu);
        }
    }

    $stmt->close();
    $conn->close();
    $returnState->success = true;
}
else
{
    $returnState->error = "No database session variables found. Try setting them first.";
    $returnState->success = false;
}

echo json_encode($returnState);

?>
