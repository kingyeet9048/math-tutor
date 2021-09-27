<!DOCTYPE html>
<html>
  <?php include('pages/components/head.php'); ?>
  <link rel="stylesheet" href="styling/MathTutor.css">
  <body>
    <h1 class="text-center"> Let's Learn Mathematics </h1>
    <div class="row mb-3">
      <div class="col d-flex justify-content-center">
        <div class="card" style="width: 30rem;">
          <img src="img/lock.png" width="128px" height="128px" class="rounded mx-auto d-block" alt="Lock">
          <div class="card-body">
              <h5 class="card-title">Welcome! Please sign in</h5>
              <form>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" class="btn btn-success" value="Login">
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
