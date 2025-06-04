<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();


if (isset($_SESSION['idOrder'])) {
    $_SESSION["id_user"];

 
    $delete = $pdo->prepare("DELETE from user where idUser = ?");
    $delete->execute([ $_SESSION["id_user"]]);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <script>
    alert("Payment failed. Please try again.");
    // Redirige a la URL de Redsys para reintentar el pago
    // Cambia esta URL por la correcta de Redsys en entorno de pruebas o producción
    window.location.href = "https://codema.fun/register";
  </script>
</head>
<body>
</body>
</html>


