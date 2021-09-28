<?php
if (!function_exists("genUniqueStarId")) //catch to prevent error of declaring function more than once
{
    function genUniqueStarId($depth=99)
    {
        include("connectToDB.php");
        $depth_left = $depth;
        $conn = connectToDB();

        $id = genRandomStarID();
        // // prepare 
        // $stmt = $conn->prepare("SELECT LGN.starID AS 'starID' FROM mathtutor.login AS LGN WHERE LGN.starID = ?");
        $stmt = $conn->prepare("SELECT TCH.teacherStarID AS 'starID', STU.studentStarID AS 'studentStarID' FROM mathtutor.teacherinfo AS TCH JOIN mathtutor.studentinfo AS STU ON (TCH.teacherStarID = ? OR STU.studentStarID = ?)");
        
        while(isset($row) == false && $depth_left > 0){
            if ($stmt != false)
            {
                $stmt->bind_param("ss", $id, $id);
    
                //execute and receive query results
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
    
                if($row != null)
                {
                    break;
                }
                else
                {
                    $id = genRandomStarID();
                }
    
                $depth_left = $depth_left - 1;
            }
            else
            {
                throw new Exception("invalid query syntax.");
                break;
            }
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
}

?>