<?php
header('Content-Type: application/json');

require_once($_SERVER['DOCUMENT_ROOT'] ."/config/bbdd_config.php");
$pdo=createConnection();

$languageName = $_GET['Language'] ?? '';

if (!$languageName) {
    echo json_encode(["error" => "No se proporcionó el nombre del lenguaje."]);
    exit;
}

$query = "
    SELECT e.idExercise, e.description, e.solution, e.extraField
    FROM exercise e
    INNER JOIN language l ON e.idLanguage = l.idLanguage
    WHERE l.name = :languageName AND e.type = 'theory'
";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':languageName', $languageName, PDO::PARAM_STR);
$stmt->execute();

$exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica si el resultado es realmente un array
if (!is_array($exercises)) {
    echo json_encode([]);
} else {
    echo json_encode($exercises);
}
