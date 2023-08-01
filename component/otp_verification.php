<?php
@include 'component/config.php';
session_start();

if (isset($_SESSION['Msg'])) {
    $error = $_SESSION['Msg'];
}

$email_sent = isset($_SESSION['email_sent']) && $_SESSION['email_sent'];

// Check if email is already set in the session and set the value of the email input field
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

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

    <!-- <?php include 'component/msg.php'; ?> -->

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="../user_db_control.php" method="POST" autocomplete="">
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
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="otp" placeholder="Enter OTP" required minlength="6" maxlength="6">
                        </div>

                        <div class="form-group">
                            <input class="form-control button" type="submit" name="check-reset-otp" value="Verify OTP">
                        </div>
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>

</body>

</html>