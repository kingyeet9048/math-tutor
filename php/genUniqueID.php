<?php

function genUniqueStarId($depth=99)
{
    include("connectToDB.php");
    $conn = connectToDB();

    $id = genRandomStarID();
    // prepare 
    $stmt = $conn->prepare("SELECT LGN.starID AS 'starID' FROM mathtutor.login AS LGN WHERE LGN.starID = ?");
    
    while(isset($row) == false && $depth > 0){
        //bind
        $stmt->bind_param("s", $id);

        //execute and receive query results
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row == null)
        {
            break;
        }
        else
        {
            $id = genRandomStarID();
        }

        $depth = $depth - 1;
    }

    return $id;
}

/***
 * Use genUniqueStarID instead. This function generates a random starID, not guaranteed to be unique.
 */
function genRandomStarID()
{
    $lets = "abcdefghijklmnopqrstuvwxyz";
    $nums = "1234567890";
    $ret = "";
    $sel = array($lets, $lets, $nums, $nums, $nums, $nums, $lets, $lets);

    foreach($sel as $str)
    {
        $ind = rand(0,strlen($str)-1);
        $ret = $ret.substr($str,$ind,1);
    }

    return $ret;
}

?>