
<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Assistance Page</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="Login.css">
    </head>
    <body>
        <br>
        <div style="position:absolute; margin:0; top:30%; left:50%; transform: translate(-50%,-30%); width: 50%;">
            <p>
                If you are a regular user, <i>you should not be here. <a href="index.php">Go back to the login page.</a></i>
                Otherwise, this page assists by specifying the database login, password, and location stored in the session variables.
            </p>
            <form action="dbAssist.php" method="post"  >
                <h2> Database Login </h2>
                Username: <input required type="text" placeholder="Enter Username" name="username" value=<?php 
                    session_start();

                    if(isset($_POST) && isset($_POST["username"]))
                    {
                        $_SESSION["DBUN"] = $_POST["username"];
                        echo $_POST["username"];
                    }
                    elseif(isset($_SESSION) && isset($_SESSION["DBUN"])) 
                    {
                        echo $_SESSION["DBUN"];
                    }
                    else
                    {
                        echo "";
                    }
                ?>>
                <br><br>
                Password: <input required type="password" placeholder="Enter Password" name="password" value=<?php 
                    if(isset($_POST) && isset($_POST["password"]))
                    {
                        $_SESSION["DBPW"] = $_POST["password"];
                        echo $_POST["password"];
                    }
                    elseif(isset($_SESSION) && isset($_SESSION["DBUN"])) 
                    {
                        echo $_SESSION["DBPW"];
                    }
                    else
                    {
                        echo "";
                    }
                ?>>
                <br><br>
                <h2> Database Location </h2>
                Location: <input required type="text" placeholder="Enter Database Location" name="location" value=<?php 

                    if(isset($_POST) && isset($_POST["location"]))
                    {
                        $_SESSION["DBLC"] = $_POST["location"];
                        echo $_POST["location"];
                    }
                    elseif(isset($_SESSION) && isset($_SESSION["DBLC"])) 
                    {
                        echo $_SESSION["DBLC"];
                    }
                    else
                    {
                        echo "localhost:3306";
                    }
                ?>>
                <br><br>
                <input type="submit">
            </form>
            <?php
                if(isset($_POST) && isset($_POST["location"]) && isset($_POST["password"]) && isset($_POST["username"]))
                {
                    echo "<p style='color:green'>Changes were successful.</p>";
                }
            ?>
            <a href="index.php">Return to login</a>
        </div>
    </body>
</html>