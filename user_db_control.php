<?php
@include 'component/config.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'component/PHPMailer/src/PHPMailer.php';
require_once 'component/PHPMailer/src/SMTP.php';
require_once 'component/PHPMailer/src/Exception.php';


function send_password_reset($get_email, $token)
{
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Your SMTP server hostname
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sohamsatvara123@gmail.com';  // Your SMTP username
    $mail->Password   = 'imsbtyfvttsfjsjm';  // Your SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sohamsatvara123@gmail.com', 'SabjiWala');
    $mail->addAddress($get_email, 'Hello user');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';

    $email_template = " 
    <h2>hello</h2>
    <h3>You are recieving this email becuase we recieved a password rest request from your account</h3><br><br>
    <h3>Your 6 Digit Code is :</h3><br>$token";

    $mail->Body = $email_template;
    $mail->send();
    $_SESSION['email_sent'] = true;
}

if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $token = md5(rand());
    $token= rand(999999, 111111);
    $check_email = "SELECT email from user_db WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);

        $get_email = $row['email'];

        $update_token = "UPDATE user_db SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if ($update_token_run) {
            send_password_reset($get_email, $token);
            $_SESSION['Msg'] = "We e-mailed you a 6 Digit code.";
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;
            $_SESSION['email_sent']=true;
            // header("Location:password_reset.php");
            header("Location:component/otp_verification.php");
            exit(0);
        } else {

            $_SESSION['Msg'] = "Something went wrong";
            header("Location:component/password_reset.php");
            exit(0);
        }
    } else {
        $_SESSION['Msg'] = "No Email Found";
        header("Location:component/password_reset.php");
        exit(0);
    }
}


if (isset($_POST['password_update'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);


    if (!empty($token)) {

        if (!empty($email) && !empty($new_password) && !empty($confirm_password) && !empty($token)) {


            $check_token = "SELECT verify_token from user_db WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($conn, $check_token);
            if (mysqli_num_rows($check_token_run) > 0) {

                if ($new_password == $confirm_password) {

                    $update_password = "UPDATE user_db SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn, $update_password);

                    if ($update_password_run) {

                        $_SESSION['Msg'] = 'Password successfully updated.!';
                        header("location:account.php");
                        exit(0);
                    } else {
                        $_SESSION['Msg'] = "Didn't update password .Something went wrong.";
                        // header("Location:password-change.php?token=$token&email=$email");
                        header("Location:component/password-change.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['Msg'] = "Password and Confirm password doesnot match.";
                    // header("Location:password-change.php?token=$token&email=$email");
                    header("Location:component/password-change.php");
                    exit(0);
                }
            } else {
                $_SESSION['Msg'] = "Invalid Token.";
                // header("Location:password-change.php?token=$token&email=$email");
                header("Location:component/password-change.php");
                exit(0);
            }
        } else {
            $_SESSION['Msg'] = "All fields are mandotary";
            // header("Location:password-change.php?token=$token&email=$email");
            header("Location:component/password-change.php");
            exit(0);
        }
    } else {
        $_SESSION['Msg'] = "No Token Available";
        header("Location:component/password_reset.php");
        exit(0);
    }
}


if (isset($_POST['check-reset-otp'])){
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM user_db WHERE verify_token = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $_SESSION['Msg'] = "Otp Verified...";
        header('location:component/password-change.php');
        exit();
    }else{
        $_SESSION['Msg'] = "You've entered incorrect code!";
        header('location:component/otp_verification.php');
    }
}


// When logout clicked

    if (isset($_POST['logout'])){

               $_SESSION = array();
                session_destroy();
                header("Location: account.php?success=logout");
                exit;
                   }

//When login Clicked 

if (isset($_POST['login'])){

    $username = $_POST["username"];
    $password = $_POST["password"];
  
    // Query to check if user exists with given username and password and retrieve name and role columns
    $sql = "SELECT name, role FROM user_db WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
  
    // If user exists, set session variable and redirect to dashboard
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["loggedInUser"] = $row["name"];
      $_SESSION["loggedInUserName"] = $username;
  
      if ($row["role"] == "admin") {
        $_SESSION["loggedInUserRole"] = "admin";
      } else {
        $_SESSION["loggedInUserRole"] = "user";
      }
  
      $_SESSION["Msg"] = "Login Successful";
  
      header("Location: index.php");
      exit();
    } else {
      // If user doesn't exist, display error message
      $_SESSION["Msg"] = "Invalid username or password";
      header("Location: account.php");
      exit();
    }
  
    // Close MySQL connection
    mysqli_close($conn);
        }


        // When register is clicked

        if (isset($_POST['signup'])){

            if(isset($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'])){

                // Get user data from the request parameters
                $name = $_POST['name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
              
                // Check if any registration detail is empty
                if(empty($name) || empty($username) || empty($password) || empty($email)){
                  $_SESSION["Msg"] = "Please fill out all the registration details.";
                  header("Location: account.php#sign-up-form");
                  exit;
                }
              
                // Check if username or email is already taken
                $check_query = "SELECT * FROM user_db WHERE username='$username' OR email='$email'";
                $check_result = mysqli_query($conn, $check_query);
              
                if (mysqli_num_rows($check_result) > 0) {
                    // Username or email is already taken
                    $_SESSION["Msg"] = "Username or email is already taken. Please choose a different one.";
                    header("Location: account.php#sign-up-form");
                } else {
                    // Add user to the database
                    $insert_query = "INSERT INTO user_db (name, username, password, email) VALUES ('$name', '$username', '$password', '$email')";
                    $insert_result = mysqli_query($conn, $insert_query);
              
                    if ($insert_result) {
                        // User added successfully
                        $_SESSION["Msg"] = "User registered successfully.";
                        header("Location: account.php#sign-in-form");
                    } else {
                        // Error adding user
                        $_SESSION["Msg"] = "Error registering user. Please try again later.";
                        header("Location: account.php#sign-up-form");
                    }
                }
              
                // Close database connection
                mysqli_close($conn);
              
              } else {
                // The form fields don't exist in the $_POST array, so the user probably accessed this script directly
                $_SESSION["Msg"] = "Please fill out the registration form first.";
                header("Location: account.php");
              }
        }