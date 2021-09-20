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
function connectToDB($location='localhost:3306',$un='root',$pw='password')
{
    if(isset($_SESSION) && isset($_SESSION["DBLC"]) && isset($_SESSION["DBUN"]) && isset($_SESSION["DBPW"]))
    {
        $location = $_SESSION["DBLC"];
        $un = $_SESSION["DBUN"];
        $pw = $_SESSION["DBPW"];
    }

    $conn = new mysqli($location, $un, $pw);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later. <br><br><a href='../dbAssist.php>Did you remember to set the login credentials for the database?</a>'<br>");
    }

    $_SESSION["DBLC"] = $location;
    $_SESSION["DBUN"] = $un;
    $_SESSION["DBPW"] = $pw;

    return $conn;
}

?>