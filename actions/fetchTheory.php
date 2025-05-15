<?php
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("
    SELECT 
        lt.*, 
        l.name AS language_name
    FROM 
        language_theory lt
    JOIN 
        language l ON lt.idLanguage = l.idLanguage
");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
