<!DOCTYPE html>
<html>
    <?php include('components/head.php') ?>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <body>
      <script>
        function forgotManager() {
          var username = document.getElementById('username');
          var password = document.getElementById('password');
          var newPassword = document.getElementById('new_password');
          var confirmPassword = document.getElementById('confirm_password');
          username.disabled = true;
          password.disabled = true;
          newPassword.disabled = true;
          confirmPassword.disabled = true;
          document.getElementById('forgot_button').disabled = true;
          if (newPassword.value == confirmPassword.value) {
            processRequest("../php/checkCreds.php", {"username": username.value, "password": password.value}).then((starID) => {
              if (starID) {
                if (starID.error) {
                  alert("Error - " + starID.error);
                }
                else if (starID.success == true) {
                  processRequest("../php/isStarIDTeacher.php", {"starID": starID.starID}).then((result) => {
                    if (result) {
                      if (result.error) {
                        alert(result.error);
                      }
                      // is a teacher
                      else if (result.isTeacher) {
                        processRequest("../php/updatePassword.php", {"role": "teacher", "starID": starID.starID, "newPassword": newPassword.value}).then((final) => {
                          if (final) {
                            if (final.error) {
                              alert(final.error);
                            }
                            else if (final.success) {
                              window.location.href = "home.php";
                            }
                            else {
                              alert("update failed. Please try again later");
                            }
                          }
                        });
                      }
                      // is a student
                      else if (!result.isTeacher) {
                        processRequest("../php/updatePassword.php", {"role": "student", "starID": starID.starID, "newPassword": newPassword.value}).then((final) => {
                          if (final) {
                            if (final.error) {
                              alert(final.error);
                            }
                            else if (final.success) {
                              window.location.href = "home.php";
                            }
                            else {
                              alert("update failed. Please try again later");
                            }
                          }
                        });
                      }
                    }
                  });
                }
                else {
                  alert("username or password incorrct.");
                }
              }
            });
          }
          else {
            alert("new password does not match confirm password.");
          }
          username.disabled = false;
          password.disabled = false;
          newPassword.disabled = false;
          confirmPassword.disabled = false;
          document.getElementById('forgot_button').disabled = false;
        }
      </script>
      <div class="form-gap"></div>
        <div class="container mt-4">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">
          
                          <form id="register-form" role="form" autocomplete="off" class="form" method="post">
          
                            <div class="form-group">
                              <div class="input-group pb-2">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input id="username" name="username" placeholder="username" class="form-control"  type="text" required>
                              </div>
                              <div class="input-group pb-2">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="password" name="password" placeholder="password" class="form-control"  type="password" required>
                              </div>
                              <div class="input-group pb-2">
                                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                  <input id="new_password" name="new_password" placeholder="new password" class="form-control"  type="password" required>
                              </div>
                              <div class="input-group pb-2">
                                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                  <input id="confirm_password" name="confirm_password" placeholder="confirm password" class="form-control"  type="password" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <input id="forgot_button" name="recover-submit" class="btn btn-lg btn-success btn-block" value="Reset Password" type="button" onclick="forgotManager();">
                            </div>
                            
                            <input type="hidden" class="hide" name="token" id="token" value=""> 
                          </form>
                          <div class="additionalInfo">
                            <p>Remeber your password? <a href="../index.php">Sign in</a>.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
      </div>
    </body>
</html>