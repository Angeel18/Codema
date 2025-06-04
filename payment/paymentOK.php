<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();


if (isset($_SESSION['idOrder'])) {
    $idOrder = $_SESSION['idOrder'];

 
    $update = $pdo->prepare("UPDATE purchase_orders SET state = 'paid' WHERE idOrder = ?");
    $update->execute([$idOrder]);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Payment successful</title>
  <script>
    alert("Payment successful");

    window.location.href = "/email/sendEmailRegister.php";
  </script>
</head>
<body>
</body>
</html>
