<!-- <html>
    testing form
    <form method="post">
    UN: <input type="text" name="username" />
    <br>
    PW: <input type="text" name="password" />
    <br>
    FN: <input type="text" name="firstName" />
    <br>
    LN: <input type="text" name="lastName" />
    <br>
    ROLE: <input type="text" name="role" />
    <br>
    <input type="submit">
    </form>
</html> -->

<?php 
//Takes the credentials given and inserts it into the database.
// 


// include("setSessionTimeout.php");
// setSessionTimeout(60*60*24); Seems to cause the cookies to wipe

if(isset($_POST) && isset($_POST["username"]))
{
    session_start();

    // $username = $_POST["username"];
    // $password = $_POST["password"];
    // $firstName = $_POST["firstName"];
    // $lastName = $_POST["lastName"];
    // $role = $_POST["role"];    

    $rawdata = file_get_contents("php://input");
    $decodedData = json_decode($rawdata);
    //getting the raw sha256 output
    $username = $decodedData->username;
    $password = $decodedData->password;
    $firstName = $decodedData->firstName;
    $lastName = $decodedData->lastName;
    $role = $decodedData->role;

    include("helper/connectToDB.php");
    $conn = connectToDB();
    
    $_SESSION["UEMAIL"] = null; //wipe username and password from session variables
    $_SESSION["UPASSWORD"] = null;
    
    include("helper/genUniqueID.php");
    $starID = genUniqueStarId();
    
    $table = $role == "teacher" ? array("teacherinfo","teacherStarID","") : array("studentinfo","studentStarID",",courseID");
    
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO mathtutor.".$table[0]."(".$table[1].$table[2].",userName,password,firstName,lastName) VALUES (".($role == "teacher" ? "" : "?,")."?,?,?,?,?);");
    if($role == "teacher") 
    {
        $stmt->bind_param("sssss", $starID, $username, $password, $firstName, $lastName);
    }
    else
    {
        $stmt2 = $conn->query("SELECT courseID from mathtutor.courses ORDER BY RAND() LIMIT 1");
        $row2 = $stmt2->fetch_assoc();
        $stmt->bind_param("sissss", $starID, $row2["courseID"], $username, $password, $firstName, $lastName);
    }
    
    //execute and receive query results
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $conn->affected_rows;
    echo $row;
    $returnState = new stdClass();
    $returnState -> success = $row != null;
    
    if($row != null) //login info succeeded
    {
        $_SESSION["USTARID"] = $starID;
        $returnState->starID = $starID;
    }
    
    echo json_encode($returnState);
    
    $stmt->close();
    $conn->close();
}
?>
