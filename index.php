<!DOCTYPE html>
<html>
  <?php include('pages/components/head.php'); ?>
  <link rel="stylesheet" href="styling/MathTutor.css">
  <body>
    <script>
      function loginManager() {
        var username = document.getElementById('username');
        var password = document.getElementById('password');
        username.disabled = true;
        password.disabled = true;
        document.getElementById('loginButton').disabled = true;
        processRequest("php/checkCreds.php", {'username': username.value, 'password': password.value}).then((result) => {
          if (result) {
            if(result.success == true) {
              window.location.href = "pages/home.php";
            }
            else if (result.error) {
              alert('Error - Please Try again: ' + result.error);
            }
            else {
              alert('Incorrect. Please try again.');
            }
          }
          username.disabled = false;
          password.disabled = false;
          document.getElementById('loginButton').disabled = false;
        });
      }
    </script>
    <h1 class="text-center"> Let's Learn Mathematics </h1>
    <div class="row mb-3">
      <div class="col d-flex justify-content-center">
        <div class="card" style="width: 30rem;">
          <img src="img/lock.png" width="128px" height="128px" class="rounded mx-auto d-block" alt="Lock">
          <div class="card-body">
              <h5 class="card-title">Welcome! Please sign in</h5>
              <form>
                <input id="username" type="text" name="username" placeholder="Username" required>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <input id="loginButton" type="button" class="btn btn-success" onclick="loginManager();" value="Login">
              </form>
            </div>
        </div>
        <div class="bottom-container">
          <div class="">
            <div class="">
              <a href="pages/signup.php" style="color:white" class="btn">Sign up</a>
            </div>
            <div class="">
              <a href="pages/forgot_password.php" style="color:white" class="btn">Forgot password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
