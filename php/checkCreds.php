<?php 
//Verifies the email and password inputted with the database.
//Takes input named 'email' and 'password'
//Verifies the username and password inputted with the database credentials.
// 
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

include("connectToDB.php");
$conn = connectToDB();

<<<<<<< Updated upstream
$_SESSION["UEMAIL"] = $email; //store email and password in session variables
=======
$_SESSION["UEMAIL"] = $username; //store username and password in session variables
>>>>>>> Stashed changes
$_SESSION["UPASSWORD"] = $password;

// prepare and bind
$stmt = $conn->prepare("SELECT LGN.password AS 'password', INF.email AS 'email' from mathtutor.login AS LGN INNER JOIN mathtutor.info AS INF ON INF.email = ? AND LGN.password = ?");
$stmt->bind_param("ss", $username, $password);

//execute and receive query results
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($row != null) //login info found
{
<<<<<<< Updated upstream
    echo "success";
=======
    $_SESSION["USTARID"] = $row["starID"];
    echo "success|";
>>>>>>> Stashed changes
}
else //Login info found
{
    echo "failure|";
}

$stmt->close();
$conn->close();

?>
