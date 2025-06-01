<?php
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("
    SELECT 
        r.*, 
        u.nickname,
        u.level
    FROM 
        ranking r
    JOIN 
        user u ON r.idUser = u.idUser
    WHERE 
        r.rankingDate = DATE_FORMAT(CURDATE(), '%Y-%m')
    ORDER BY 
        r.points DESC
    limit 10;
");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
