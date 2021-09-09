<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
    </style>
    <script src=""></script>
    <body>
        <p>Login</p>
        <form class="form" id="loginForm" method="post" action="php/checkCreds.php">
            <p>E-mail: <input type="text" name="email" value=""></p>
            <p>Password: <input type="password" name="password" value=""></p>
            <input type="submit">
        </form>

        <?php 
            if (isset($_GET["error"]))
            {
                echo "<br>Error code ".htmlspecialchars($_GET["error"]);
            }
        ?>

    </body>
</html> 