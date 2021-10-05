<?php 
session_start();
include("helper/connectToDB.php");
$conn = connectToDB();
<<<<<<< Updated upstream
$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);
=======
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);
>>>>>>> Stashed changes
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

        $starID = $decodedData->starID;
    }
    
    if($starID != null)
    {
        // prepare and bind
        $stmt = $conn->prepare("SELECT STU.courseID AS 'courseID' FROM mathtutor.studentinfo AS STU WHERE STU.studentStarID = ?;");
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
<<<<<<< Updated upstream
            $returnState->courseName = $row["courseName"];
=======
            $returnState->studentStarID = $starID;
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                    $question->questionID = $row["questionID"];
                    $question->studentStarID = $row["studentStarID"];
                    $question->questionNumber = $row["questionNumber"];
                    $question->questionType = $row["questionType"];
                    $question->questionID = $row["questionID"];
                    $question->isOverride = $row["isOverride"];
=======
                    $question->questionID = $row2["questionID"];
                    $question->studentStarID = $row2["studentStarID"];
                    $question->questionNumber = $row2["questionNumber"];
                    $question->questionType = $row2["questionType"];
                    $question->questionID = $row2["questionID"];
                    $question->isOverride = $row2["isOverride"];
>>>>>>> Stashed changes
                    array_push($returnState->questions,$question);
                }
            }
        }
        else
        {
            $stmt->close();
        }
<<<<<<< Updated upstream
    
=======
        $returnState->success=true;
>>>>>>> Stashed changes
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