<?php
session_start();
$userId = isset($_SESSION["id_user"]) ? header("location:/") : "" ;
if (isset($_SESSION['is_superuser'])) {
session_destroy();
session_start();
}
// if (isset($_SESSION["id_user"])) {
//     header("Location: ./courses");
//     exit; // Muy importante para evitar que el resto del script se ejecute
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Codema – Login</title>
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
  <section class="auth-section ">
    <div class="container">
      <h2 class="section-title">Login to Your Account</h2>
      <form class="auth-form" action="#" method="post">
        <label for="login-email">Email Address</label>
        <input type="email" id="login-email" placeholder="you@example.com" required name="email">

        <label for="login-password">Password</label>
        <input type="password" id="login-password" placeholder="••••••••" required name="password">

        <button type="submit" class="btn">Login</button>
        <p>Don't have an account?<br><br> <a href="register" class="btn-outline">Register</a></p>
      </form>
    </div>
  </section>

      <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
</body>
<script src="../scripts/login.js"></script>
</html>

