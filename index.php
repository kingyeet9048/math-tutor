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

<<<<<<< Updated upstream
        <?php 
            if (isset($_GET["error"]))
            {
                echo "<br>Error code ".htmlspecialchars($_GET["error"]);
            }
        ?>
=======
    <div id="id01" class="modal">
      
      <form class="modal-content animate" action="php/checkCreds.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="ELE.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Email" name="email" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
            
          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
      <?php 
        if (isset($_GET["error"]))
        {
            echo "<br>Error code ".htmlspecialchars($_GET["error"]);
        }
      ?>
      <!-- This is here since it's for our development purposes. It can be commented, just wanted to include the link. ~ Ashton -->
      <br><a href="dbAssist.php">Goto database assistance page</a>
    </div>
  </body>
</html>
>>>>>>> Stashed changes

    </body>
</html> 