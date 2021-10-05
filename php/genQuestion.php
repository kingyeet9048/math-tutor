<?php 
session_start();

$returnState = new stdClass();
//getting the raw sha256 output
$starID = $_SESSION["USTARID"];
$rawdata = file_get_contents("php://input");
$decodedData = json_decode($rawdata);

$answer_formats = array(
    "X, X, ?", //count
<<<<<<< Updated upstream
    array("X    ?<br>--------", "?    X<br>--------"), //recognize numberline
=======
    array("X--->?", "?<---X"), //recognize numberline
>>>>>>> Stashed changes
    "X + ? = A", //add to 10
    "X + X + ? = A", //add to 20
    "  X<br>+ ?<br>----<br>   A", //missing number to make ten/twenty
    "X + X + X = ?", //add three
    "  X<br>+ X<br>----<br>   ?"); //two digit (carry and no carry)

<<<<<<< Updated upstream
$answer_data = array(
    9,
    array(10,1),
    10,
    20,
    20,
    array(20,20));

$questionType = $decodedData->questionType;
=======
$questionTypes = array(
    "Count",
    "Recognize",
    "Add to 10",
    "Add to 20",
    "Add to 10/20",
    "Add three",
    "Two digit"
);

$answer_data = array(
    rand(0,8),
    array(rand(6,10),rand(1,5)),
    10,
    20,
    array(10,20),
    20,
    10);

$questionType = 2;///$decodedData->questionType;
>>>>>>> Stashed changes

$sel_format = $answer_formats[$questionType];
$init_sel_data = $answer_data[$questionType];
$sel_data = $answer_data[$questionType];
<<<<<<< Updated upstream

$formatted_q = "";

if(gettype($sel_format) == "array")
{
    $sel_format = $sel_format[rand(0,1)];
}

$found_params = 0;
=======
$multi_meta_ind = 0;

$formatted_q = "";


if(gettype($sel_format) == "array")
{
    $ind = rand(0,1);
    $sel_format = $sel_format[$ind];

    if($questionType == 1 || $questionType == 4)
    {
        $sel_data = $sel_data[$ind];
        $init_sel_data = $sel_data;
    }

    $multi_meta_ind = $ind;
}

if($questionType == 4)
{
    $ind = rand(0,1);
    $sel_data = $sel_data[$ind];
    $init_sel_data = $sel_data;
    $multi_meta_ind = $ind;
}

$paramCount = 0;
>>>>>>> Stashed changes
$total_sum = 0;
$equals_flag = false; //used to set is_answer_sum
$is_answer_sum = false;

for($i = 0; $i < strlen($sel_format); ++$i) 
{
    $char = $sel_format[$i];

    if($char == "X")
    {
<<<<<<< Updated upstream
        $found_params += 1;

        $val = rand(1,$sel_data2);
        if(gettype($sel_data) == "array")
        {
            $val = rand(1,$sel_data[$found_params - 1]);
            $sel_data[$found_params - 1] -= $val; //create a maximum
=======
        $paramCount += 1;

        $val = rand(1,$sel_data);
        if($questionType == 0)
        {
            $val = $paramCount + $sel_data;
        }
        elseif($questionType == 1)
        {
            $val = $sel_data;
        }
        elseif($questionType == 6)
        {
            $val += ($paramCount == 1 ? 8 : 3);
        }
        elseif(gettype($sel_data) == "array")
        {
            $val = rand(1,$sel_data[$paramCount - 1]);
            $sel_data[$paramCount - 1] -= $val; //create a maximum
>>>>>>> Stashed changes
        }
        else
        {
            $sel_data -= $val; //create a maximum
        }

<<<<<<< Updated upstream
=======
        if($val < 0)
        {
            $val = -$val;
        }
        

>>>>>>> Stashed changes
        $total_sum += $val;
        $formatted_q = $formatted_q.$val;
    }
    elseif($char == "A")
    {
<<<<<<< Updated upstream
        $formatted_q = $formatted_q.$total_sum;
=======
        if($questionType == 0)
        {
            $formatted_q = $formatted_q.($paramCount + $answer_data[0]);
        }
        elseif($questionType == 1)
        {
            $formatted_q = $formatted_q.($answer_data+($multi_meta_ind == 1 ? -1 : 1));
        }
        elseif($questionType == 2)
        {
            $formatted_q = $formatted_q.(10);
        }
        elseif($questionType == 3)
        {
            $formatted_q = $formatted_q.(20);
        }
        elseif($questionType == 4)
        {
            $formatted_q = $formatted_q.$init_sel_data;
        }
        elseif($questionType == 5)
        {
            $formatted_q = $formatted_q.$total_sum;
        }
>>>>>>> Stashed changes
    }
    elseif($char == "?")
    {
        if($equals_flag)
        {
            $is_answer_sum = true;
        }

        $formatted_q = $formatted_q.$char;
    }
<<<<<<< Updated upstream
    else
=======
    elseif($char == "=")
    {
        $equals_flag = true;
        $formatted_q = $formatted_q.$char;
    }
    elseif($char == " " || $char == "<" || $char=="b"||$char=="r"||$char==">"||$char=="+"||$char="-")
>>>>>>> Stashed changes
    {
        $formatted_q = $formatted_q.$char;
    }
}

$correct_option = rand(0,3);
$options = array();

<<<<<<< Updated upstream
=======
$prev_options = array();

function genUnique($total_sum, $prev_options, $depth=99)
{
    $choice = rand(1,99);
    if($depth > 0)
    {
        for($l = 0; $l < count($prev_options); ++$l)
        {
            if($choice == $prev_options[$l])
            {
                return genUnique($total_sum, $prev_options, $depth-1);
            }
        }    
    }

    return $choice;
}

>>>>>>> Stashed changes
for($i = 0; $i < 4; ++$i)
{
    if($i == $correct_option)
    {
<<<<<<< Updated upstream
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
=======
        if($questionType == 1)
        {
            array_push($options,$sel_data+($multi_meta_ind == 1 ? -1 : 1));
            array_push($prev_options,$sel_data+($multi_meta_ind == 1 ? -1 : 1));
        }
        elseif($questionType >= 2 && $questionType <= 4)
        {
            array_push($options,$init_sel_data-$total_sum);
            array_push($prev_options,$init_sel_data-$total_sum);
        }
        elseif($questionType == 5 || $questionType == 6)
        {
            array_push($options,$total_sum);
            array_push($prev_options,$total_sum);
        }
        else
        {
            array_push($options,$is_answer_sum ? $init_sel_data : $total_sum-$init_sel_data);
            array_push($prev_options,$is_answer_sum ? $init_sel_data : $total_sum-$init_sel_data);
    
        }
    }
    else
    {
        $entry = genUnique($total_sum,$prev_options);
        array_push($options,$entry);
        array_push($prev_options, $entry);
    }
}

$returnState->answer = $correct_option;
$returnState->options = $options;
$returnState->question = $formatted_q;
$returnState->success = true;
$returnState->typeLabel = $questionTypes[$questionType];
>>>>>>> Stashed changes

echo json_encode($returnState);

?>