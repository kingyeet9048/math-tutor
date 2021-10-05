<?php
/***
 * Attempts to connect to the database with the session variables if they exist, otherwise resorts to defaults specified. 
 * If connection is successful, sets session variables to correct credentials and returns the connection.
 * Otherwise, dies with a link to the dbAssist page.
 * 
 * @param string $location The ip & port of the database to connect to. Defaults to 'localhost:3306'.
 * @param string $un The username to login to the database with. Defaults to 'root'.
 * @param string $pw The password to login to the database with. Defaults to 'password'.
 * 
 */
if (!function_exists("connectToDB")) //catch to prevent error of declaring function more than once
{
    function connectToDB($location='localhost:3306',$un='root',$pw='password')
    {
        mysqli_report(MYSQLI_REPORT_STRICT);
        $loc2 = $location;
        $un2 = $un;
        $pw2 = $pw;
    
        if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
        {
            $loc2 = $_SESSION["DBLC"];
            $un2 = $_SESSION["DBUN"];
            $pw2 = $_SESSION["DBPW"];
        }
    
        try {
            $conn = new mysqli($loc2, $un2, $pw2);
            $_SESSION["DBLC"] = $loc2;
            $_SESSION["DBUN"] = $un2;
            $_SESSION["DBPW"] = $pw2;
            $_SESSION["DBCONNECTION"] = true;
    
            if ($conn->connect_error) {
                throw new Exception();
            }
    
            return $conn;
        }
        catch(Exception $e)
        {
            $returnState = new stdClass();
            $returnState->error = "<div class='connectError'>Cannot connect to MySQL server to verify credentials. (Credentials: UN=".$un2.", PW=".$pw2.", LOC=".$loc2.") Please try again later. <a href='.../dbAssist.php'>Did you remember to set the login credentials for the database?</a></div>";
            $returnState->success = false;
            echo json_encode($returnState);
            exit;
        }
    } 
}


?>