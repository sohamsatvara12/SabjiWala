<?php
@include 'component/config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>SabjiWala-Login</title>

  <!-- <link rel="stylesheet" href="account.css"> -->
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body style="background: white;">


  <?php include 'component/msg.php'; ?>


  <!-- Header Part -->

  <?php include 'component/header.php'; ?>


  <!-- Login page -->


  <section class="login" id="login" style="padding: 0rem 0%;">
    <div class="account-container">
      <div class="forms-container">
        <div class="signin-signup">

          <form action="user_db_control.php" method="post" class="sign-in-form" onsubmit="return validateLoginForm()" name="signinForm">


            <h2 class="title">Sign in</h2>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" style="text-transform:none;" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" />
            </div>
            <input type="submit" value="Login" class="account-btn solid" name="login" />
            <p class="social-text">forgot your password?<a href="component/password_reset.php" style="color:#ff7800;">Click Here.</a></p>
            <p class="social-text">Or Sign in with social platforms</p>

            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
            <br>

          </form>

          <!-- Javascript Validation for Login -->

          <script>
            function validateLoginForm() {
              var username = document.forms["signinForm"]["username"].value;
              var password = document.forms["signinForm"]["password"].value;

              if (username.trim() === "") {
                alert("Please enter a username.");
                return false;
              }

              if (password.trim() === "") {
                alert("Please enter a password.");
                return false;
              }

              return true;
            }
          </script>

          <form action="user_db_control.php" method="post" class="sign-up-form" style="text-transform:none;" name="signupForm" onsubmit="return validateForm()" ">

            <h2 class=" title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Your Name" name="name" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" style=" text-transform:none;" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" style=" text-transform:none; " />
            </div>
            
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" style=" text-transform:none;" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="confirmPassword" style=" text-transform:none;" />
            </div>
            <input type="submit" class="account-btn" value="Sign up" name="signup" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
            <br>
          </form>
        </div>
      </div>

      <!-- Javascript validation for Sign up  -->

      <script>
        function validateForm() {
          var name = document.forms["signupForm"]["name"].value;
          var username = document.forms["signupForm"]["username"].value;
          var password = document.forms["signupForm"]["password"].value;
          var confirmPassword = document.forms["signupForm"]["confirmPassword"].value;
          var email = document.forms["signupForm"]["email"].value;

          // Check if name contains a number
          if (/\d/.test(name)) {
            alert("Name cannot contain a number");
            return false;
          }
          var emailPattern = /\S+@\S+\.\S+/;
          if (!emailPattern.test(email)) {
            alert("Email is not valid");
            return false;
          }
          // Check username pattern
          var usernamePattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/;
          if (!usernamePattern.test(username)) {
            alert("Username must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and be between 8 and 12 characters");
            return false;
          }

          // Check password pattern
          var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/;
          if (!passwordPattern.test(password)) {
            alert("Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and be between 8 and 12 characters");
            return false;
          }

          if (password != confirmPassword) {
            alert("Password and Confirm password do not match.");
            return false;
          }
          // Check if email is valid


          return true;
        }
      </script>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3 style="margin-top: 2rem;">New here ?</h3>
            <!-- <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                ex ratione. Aliquid!
              </p> -->
            <button class="btn transparent" id="sign-up-btn" style=" background: #ff7800;border: 2px solid #fff;color:#fff;">
              Sign up
            </button>
          </div>

          <img src="images/loginimg/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3 style="margin-top: 3rem;">One of us ?</h3>
            <!-- <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                laboriosam ad deleniti.
              </p> -->
            <button class="btn transparent" id="sign-in-btn" style="color:white;">
              Sign in
            </button>
          </div>


          <img src=" images/loginimg/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
  </section>
  <script src="js/app.js"></script>

  <!-- Footer Section -->

  <?php include 'component/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

</body>

</html>

<script src="js/script.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>