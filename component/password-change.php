<?php
@include 'component/config.php';
session_start();

if (isset($_SESSION['Msg'])) {
  $error = $_SESSION['Msg'];
}

$email_sent = isset($_SESSION['email_sent']) && $_SESSION['email_sent'];

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$token = '';
if (isset($_SESSION['token'])) {
  $token = $_SESSION['token'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/forgot_password.css">

</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form">
        <form action="../user_db_control.php" method="POST" autocomplete="" onsubmit="return validateForm()">

          <h2 class="text-center">Forgot Password</h2>
          <p class="text-center">Enter your email address</p>

          <?php

          if (isset($error)) {
          ?>
            <div class="alert alert-danger text-center">
              <?php
              echo $error;
              ?>
            </div>
          <?php
          }
          ?>

          <?php if (!isset($_SESSION['email-sent'])) { ?>

            <input type="hidden" name="password_token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="new_password">New Password:</label>
              <input class="form-control" type="password" id="new-password" name="new_password" required>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm New Password:</label>
              <input class="form-control" type="password" id="confirm-password" name="confirm_password" rquired>
            </div>
            <div class="form-group">
              <input class="form-control button" type="submit" name="password_update" value="Update Password">
            </div>

          <?php } ?>

        </form>
      </div>
    </div>
  </div>
  <script>
    function validateForm() {
      var password = document.getElementById("new-password").value;
      var confirmPassword = document.getElementById("confirm-password").value;

      var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/;
      if (!passwordPattern.test(password)) {
        alert("Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and be between 8 and 12 characters");
        return false;
      }

      if (password != confirmPassword) {
        alert("Password and Confirm Password do not match");
        return false;
      }

      return true;
    }
  </script>

</body>

</html>