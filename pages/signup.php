<!DOCTYPE html>
<html>
<?php include('components/head.php') ?>
<link rel="stylesheet" href="../styling/signup.css">
<body>
<form action="../php/signUp.php">
  <div class="container">
    <h1>Register</h1>
    <hr>
        <div class="formHeaders">

    <label for="first-name"><b>First Name:  </b></label>
    <input type="text" placeholder="Enter First Name" name="first name" id="first-name" required>
      <br>
    <label for="last-name"><b>Last Name:  </b></label>
    <input type="text" placeholder="Enter Last Name" name="last name" id="last-name" required>
      <br>
    <label for="email"><b>Email:  </b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>
      <br>
    <label for="user-name"><b>User Name:  </b></label>
    <input type="text" placeholder="Enter User Name" name="user name" id="user-name" required>
      <br>
    <label for="psw"><b>Password:  </b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      <br>
    <label for="psw-repeat"><b>Confirm Password:  </b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

        </div>
      <hr>
        </div>
    <div class="additionalInfo">
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
    </div>

  <div class="additionalInfo">
    <p>Already have an account? <a href="../index.php">Sign in</a>.</p>
  </div>
</form>
</body>
</html>