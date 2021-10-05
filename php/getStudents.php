<?php
    session_start();
    $returnState = new stdClass();
    
    if(isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
    {
        $rawdata = file_get_contents("php://input");
        $decodedData = json_decode($rawdata);

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
        $stmt = $conn->prepare("CALL mathtutor.getClassStudents(?);");
        $stmt->bind_param("s", $courseName);
    
        //execute and receive query results
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $returnState->success = !empty($row);
        $returnState->students = array();
        if ($returnState->success) {
            while($row = mysqli_fetch_assoc($result)) {
                if(!empty($row))
                {
                    $students = new stdClass();
                    $students->starID = $row["studentStarID"];
                    $students->firstName = $row["firstName"];
                    $students->lastName = $row["lastName"];
                    array_push($returnState->students,$students);
                }
            }
        }
        else {
            $stmt->close();
        }
        $conn->close();
    }
    else
    {
        $returnState->error = "No database session variables found. Try setting them first.";
        $returnState->success = false;
    }
    
    echo json_encode($returnState);
    
?>