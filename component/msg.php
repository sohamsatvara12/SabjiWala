<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    /* CSS for the drop-down div block */
    .message {
      position: fixed;
      top: -100px;
      left: 50%;
      transform: translate(-50%, 0%);
      z-index: 9999;
      width: 400px;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      animation: slide-down 0.5s ease-out forwards;
      margin-top: 2.5rem;
    }

    .message p {
      font-size: 1.9rem;
    }

    .close-btn {
      position: absolute;
      top: 0;
      right: 0;
      color: #aaa;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }

    .progress-bar {
      height: 5px;
      background-color: #ccc;
      margin-top: 10px;
      overflow: hidden;
    }

    .progress-bar-fill {
      height: 100%;
      width: 100%;
      background-color: #4CAF50;
      animation: progress-fill linear forwards;
    }

    /* CSS for the animation */
    @keyframes slide-down {
      0% {
        top: -100px;
        opacity: 0;
      }

      100% {
        top: 50px;
        opacity: 1;
      }
    }

    @keyframes progress-fill {
      0% {
        width: 100%;
      }

      100% {
        width: 0;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var messageElement = document.querySelector('.message');
      var closeBtn = document.querySelector('.close-btn');
      var progressBarFill = document.querySelector('.progress-bar-fill');

      if (messageElement) {
        closeBtn.addEventListener('click', function() {
          messageElement.style.display = 'none';
        });

        var messageDuration = 2000; // Set the duration of the message in milliseconds
        var progressBarAnimationDuration = messageDuration / 1000 + 's';

        progressBarFill.style.animationDuration = progressBarAnimationDuration;

        setTimeout(function() {
          messageElement.style.display = 'none';
        }, messageDuration);
      }
    });
  </script>
</head>

<body>
  <?php
  session_start();

  if (isset($_SESSION['Msg'])) {
    echo '<div class="message">';
    echo '<span class="close-btn" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
    echo '<p class="message-text">' . $_SESSION['Msg'] . '</p>';
    echo '<div class="progress-bar"><div class="progress-bar-fill"></div></div>';
    echo '</div>';
    unset($_SESSION['Msg']);
  } elseif (isset($_GET['success']) && $_GET['success'] == 'logout') {
    echo '<div class="message success">';
    echo '<span class="close-btn" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
    echo '<p class="message-text">You have been successfully logged out.</p>';
    echo '<div class="progress-bar"><div class="progress-bar-fill"></div></div>';
    echo '</div>';
  }
  ?>
</body>

</html>
