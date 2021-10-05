<?php 
session_start();

$returnState = new stdClass();
//getting the raw sha256 output
$starID = $_SESSION["USTARID"];
$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);

$answer_formats = array(
    "X, X, ?", //count
    array("X    ?<br>--------", "?    X<br>--------"), //recognize numberline
    "X + ? = A", //add to 10
    "X + X + ? = A", //add to 20
    "  X<br>+ ?<br>----<br>   A", //missing number to make ten/twenty
    "X + X + X = ?", //add three
    "  X<br>+ X<br>----<br>   ?"); //two digit (carry and no carry)

$answer_data = array(
    9,
    array(10,1),
    10,
    20,
    20,
    array(20,20));

$questionType = $decodedData->questionType;

$sel_format = $answer_formats[$questionType];
$init_sel_data = $answer_data[$questionType];
$sel_data = $answer_data[$questionType];

$formatted_q = "";

if(gettype($sel_format) == "array")
{
    $sel_format = $sel_format[rand(0,1)];
}

$found_params = 0;
$total_sum = 0;
$equals_flag = false; //used to set is_answer_sum
$is_answer_sum = false;

for($i = 0; $i < strlen($sel_format); ++$i) 
{
    $char = $sel_format[$i];

    if($char == "X")
    {
        $found_params += 1;

        $val = rand(1,$sel_data2);
        if(gettype($sel_data) == "array")
        {
            $val = rand(1,$sel_data[$found_params - 1]);
            $sel_data[$found_params - 1] -= $val; //create a maximum
        }
        else
        {
            $sel_data -= $val; //create a maximum
        }

        $total_sum += $val;
        $formatted_q = $formatted_q.$val;
    }
    elseif($char == "A")
    {
        $formatted_q = $formatted_q.$total_sum;
    }
    elseif($char == "?")
    {
        if($equals_flag)
        {
            $is_answer_sum = true;
        }

        $formatted_q = $formatted_q.$char;
    }
    else
    {
        $formatted_q = $formatted_q.$char;
    }
}

$correct_option = rand(0,3);
$options = array();

for($i = 0; $i < 4; ++$i)
{
    if($i == $correct_option)
    {
        array_push($options,$is_answer_sum ? $init_sel_data : $init_sel_data-$total_sum);
    }
    else
    {
        array_push($options,rand(1,$total_sum*2));
    }
}

$returnState->answer = 0;
$returnState->options = $options;
$returnState->question = $formatted_q;

echo json_encode($returnState);

?>