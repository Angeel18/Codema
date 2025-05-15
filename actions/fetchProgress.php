<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("SELECT 
  DATE_FORMAT(doneDate, '%M') AS month,
  COUNT(*) AS exercisesDone
FROM progress
WHERE idUser = :idUser
GROUP BY DATE_FORMAT(doneDate, '%M')
ORDER BY month;
");

$stmt->bindParam(":idUser", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
?>
