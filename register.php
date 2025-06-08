<?php
session_start();
// $userId = isset($_SESSION["id_user"]) ? header("location:./courses.php") : "" ;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="media/favicon.png">
  <title>Codema – Register</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/homeStyles.css">
  <link rel="stylesheet" href="styles/auth.css">
</head>

<body>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
  ?>

  <section class="auth-section reveal">
    <div class="container">
      <h2 class="section-title">Create a New Account</h2>
      <form id="register-form" class="auth-form" action="/payment/payment.php" method="post">
        <div class="auth-row">
          <div class="auth-group">
            <label for="reg-name">First Name</label>
            <input type="text" id="reg-name" name="name" placeholder="First Name" required>
          </div>
          <div class="auth-group">
            <label for="reg-surname">Surname</label>
            <input type="text" id="reg-surname" name="surname" placeholder="Surname" required>
          </div>
        </div>

        <label for="reg-nickname">Nickname</label>
        <input type="text" id="reg-nickname" name="nickname" placeholder="Nickname" required>

        <label for="reg-email">Email Address</label>
        <input type="email" id="reg-email" name="email" placeholder="you@example.com" required>

        <div class="auth-row">
          <div class="auth-group">
            <label for="reg-password">Password</label>
            <input type="password" id="reg-password" name="password" placeholder="••••••••" required>
          </div>
          <div class="auth-group">
            <label for="reg-confirm-password">Confirm Password</label>
            <input type="password" id="reg-confirm-password" name="confirm_password" placeholder="••••••••" required>
          </div>
        </div>


        <label for="sel-plan">Selected Plan</label>
        <select name="sel-plan" id="sel-plan">
          <option value="" selected disabled>Select a plan</option>
        </select>

        <label>
          <input type="checkbox" name="terms" required>
          I accept the <a href="terms" target="_blank" style="color: var(--secondary-color)">Terms and Conditions</a>
        </label>
        <button type="submit" class="btn">Register</button>
        <p>Already have an account? <a href="login" class="btn-outline">Login</a></p>
      </form>
    </div>


  </section>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
  <!-- Registration fetch script -->
  <script src="scripts/register.js"></script>
</body>

</html>