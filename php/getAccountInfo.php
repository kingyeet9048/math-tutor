<?php 
//Accepts starid. Returns the given fields data from the DB. 
//      Ex -> I send a request to PHP form some data. I send the star id with the request. 
//      The form takes the request, checks with the DB, and returns the data.
//
//      Returns: last signed in, role type, first name, last name
session_start();

if(isset($_SESSION["DBCONNECTION"]))
{
    $starID = 1; //$_POST["starID"]; Once frontend is done this can be uncommented

    $conn = new mysqli("localhost:3306", $_SESSION["DBUN"], $_SESSION["DBPW"]);

    if ($conn->connect_error) {
        die("Cannot connect to MySQL server to verify credentials. Please try again later.<br>");
    }

    // prepare and bind
    $stmt = $conn->prepare("SELECT CONCAT(INF.firstName, CONCAT(' ', INF.lastName)) AS 'name', INF.firstName AS 'firstName', INF.lastName AS 'lastName', INF.role AS 'role', LGN.datetime AS 'timestamp' from mathtutor.login AS LGN INNER JOIN mathtutor.info AS INF ON INF.starID = ? AND LGN.starID = ?");
    $stmt->bind_param("ss", $starID, $starID);

    //execute and receive query results
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    //
    echo "success|".$row["name"].",".$row["role"].",".$row["timestamp"];
}
else
{
    echo "failure|";
}

?>