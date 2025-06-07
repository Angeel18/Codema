<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();

if (isset($_SESSION['idOrder'])) {
  $idOrder = $_SESSION['idOrder'];
    $update = $pdo->prepare("UPDATE purchase_orders SET state = 'paid' WHERE idOrder = ?");
    $update->execute([$idOrder]);

   
    $select = $pdo->prepare("SELECT idUSER from purchase_orders WHERE idOrder = ?");
    $select->execute([$idOrder]);

    $idUser=$select->fetch(PDO::FETCH_ASSOC);
    // $_SESSION["id_user"] = $idUser;
} 


?>



<body>

  <form id="redirectForm" action="../email/sendEmailRegister.php" method="POST">
    <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($idUser['idUSER'] ?? ''); ?>">
  </form>

<script>
    document.getElementById('redirectForm').submit();
  </script>
</body>