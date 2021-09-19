<?php
    $myObject = new stdClass();
    $myObject->courseID = "1232fgrews";
    $myObject->courseLevel = "k-1st";
    $myObject->lessonsTeaching = "1, 2, 3, 4";
    $myObject->customLession = "Count to 50!";
    $question1 = new stdClass();
    $question1->ID = "asdfasd234";
    $question1->courseID = "1232fgrews";
    $question1->questionNumber = 1;
    $question1->questionType = 4;
    $question2 = new stdClass();
    $question2->ID = "awqr564";
    $question2->courseID = "1232fgrews";
    $question2->questionNumber = 2;
    $question2->questionType = 7;
    $array = array((array)$question1, (array)$question2);
    $myObject->questions = $array;
    echo json_encode($myObject);

?>