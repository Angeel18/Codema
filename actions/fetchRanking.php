<?php
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("SELECT 
    r.*, 
    u.nickname,
    u.level
FROM 
    ranking r
JOIN 
    user u ON r.idUser = u.idUser
WHERE 
    (
        (YEAR(r.rankingDate) = YEAR(CURDATE()) AND MONTH(r.rankingDate) = MONTH(CURDATE()) - 1)
        OR
        (MONTH(CURDATE()) = 1 AND YEAR(r.rankingDate) = YEAR(CURDATE()) - 1 AND MONTH(r.rankingDate) = 12)
    )
order by r.points desc");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
