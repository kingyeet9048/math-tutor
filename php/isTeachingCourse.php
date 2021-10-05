<?php 
session_start();
include("helper/connectToDB.php");
$conn = connectToDB();
$starID = $_SESSION["USTARID"];


$returnState = new stdClass();

if(!isset($_SESSION) && !isset($decodedData->starID))
{
    $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
}
else
{
    //getting the raw sha256 output
    $starID = $_SESSION["USTARID"];
    if(!isset($starID))
    {
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);
        $starID = $decodedData->starID;
    }
    
    if($starID != null)
    {
        // prepare and bind
        $stmt = $conn->prepare("SELECT CRS.courseName AS 'courseName', CRS.courseID AS 'courseID' FROM mathtutor.courses AS CRS WHERE CRS.teacherStarID = ?;");
        $stmt->bind_param("s", $starID);
    
        //execute and receive query results
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $returnState->success = !empty($row);

        if($returnState->success)
        {
            $stmt->close();
            $returnState->courseID = $row["courseID"];
            $returnState->courseName = $row["courseName"];
            $returnState->questions = array();

            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM mathtutor.questions WHERE courseID = ?;");
            $stmt->bind_param("s", $row["courseID"]);
        
            //execute and receive query results
            $stmt->execute();
            $result = $stmt->get_result();

            while($row2 = mysqli_fetch_assoc($result)) {
                if(!empty($row2))
                {
                    $question = new stdClass();
                    $question->questionID = $row["questionID"];
                    $question->studentStarID = $row["studentStarID"];
                    $question->questionNumber = $row["questionNumber"];
                    $question->questionType = $row["questionType"];
                    $question->questionID = $row["questionID"];
                    $question->isOverride = $row["isOverride"];
                    array_push($returnState->questions,$question);
                }
            }
        }
        else
        {
            $stmt->close();
        }
    
        $conn->close();
    }
    else
    {
        $returnState->success = false;
        $returnState->error = "StarID was not found. Try passing 'starID' as a parameter when calling this script.";
    }
}

echo json_encode($returnState);

?>