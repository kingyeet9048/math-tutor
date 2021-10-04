<?php
    $my = new stdClass();
    $student = new stdClass();
    $student->starID = "1223";
    $student->firstName = "Jason";
    $student->lastName = "Filler";
    $student->percent = 95;
    $student2 = new stdClass();
    $student2->starID = "145";
    $student2->firstName = "Aly";
    $student2->lastName = "Fiehgt";
    $student2->percent = 20;
    $array = array((array) $student, (array)$student2);
    $my->students = $array;
    echo json_encode($my);
?>