<?php
// Conexión a la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] ."/config/bbdd_config.php");
$pdo=createConnection();
// print_r($_SERVER['DOCUMENT_ROOT'] ."/config/bbdd_config.php");

// // Obtener el contenido JSON del POST
$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

$languageName = $data['Language'] ?? '';
$type = $data['Type'] ?? '';

$query = "
    SELECT e.idExercise, e.description, e.solution, e.extraField
    FROM exercise e
    INNER JOIN language l ON e.idLanguage = l.idLanguage
    WHERE l.name = :languageName AND e.type = :type
";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':languageName', $languageName, PDO::PARAM_STR);
$stmt->bindParam(':type', $type, PDO::PARAM_STR);

$stmt->execute();

$exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($exercises);

?>