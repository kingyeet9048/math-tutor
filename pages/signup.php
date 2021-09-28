<!DOCTYPE html>
<html>
<?php include('components/head.php') ?>
<link rel="stylesheet" href="../styling/signup.css">
<body>
  <script>
    function signupManager() {
      var firstName = document.getElementById('first-name').value;
      var lastName = document.getElementById('last-name').value;
      var username = document.getElementById('user-name').value;
      var password = document.getElementById('psw').value;
      var confirmPassword = document.getElementById('psw-repeat').value;
      var selectRole = document.getElementById('selectID');
      var roleType = selectRole.options[selectRole.selectedIndex].value;
      if (password != confirmPassword) {
        alert('Password does not match confirm password');
      }
      else {
        signup({'firstName': firstName, 'lastName': lastName, 'username': username, 'password': password, 'role': roleType}).then((result) => {
          if (result) {
            if(result.success) {
                window.location.href = "home.php";
            }
            else {
              alert('Something went wrong during sign up. Please try again.');
            }
          }
        });
      }
    }
  </script>
<form>
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
    <label for="user-name"><b>User Name:  </b></label>
    <input type="text" placeholder="Enter User Name" name="user name" id="user-name" required>
      <br>
    <label for="psw"><b>Password:  </b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
      <br>
    <label for="psw-repeat"><b>Confirm Password:  </b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
      <br>
    <label for="select"><b>Role Type:  </b></label>
    <select name="select" id="selectID">
      <option value="student">Student</option>
      <option value="teacher">Teacher</option>
    </select>
        </div>
      <hr>
        </div>
    <div class="additionalInfo">
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="button" class="btn btn-success" onclick="signupManager();">Register</button>
    </div>

  <div class="additionalInfo">
    <p>Already have an account? <a href="../index.php">Sign in</a>.</p>
  </div>
</form>
</body>
</html>