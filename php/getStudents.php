<?php
    $myObject = new stdClass();
    $arrayHere = array();
    for ($i=0; $i < 5; $i++) { 
        $currentStudent = new stdClass();
        $currentStudent->starID = $i;
        $currentStudent->firstName = "John the".$i;
        $currentStudent->lastName = "Doe".$i;
        array_push($arrayHere, (array)$currentStudent);
    }
    $myObject->students = $arrayHere;
    echo json_encode($myObject);
?>