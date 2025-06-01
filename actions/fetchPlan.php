<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("SELECT *
from plan");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
