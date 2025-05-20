<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

$languageName = $data['Language'] ?? '';
$type = $data['Type'] ?? '';
$idExercise = $data['idExercise'] ?? null;

if (!$languageName || !$type) {
    echo json_encode(["error" => "Missing language or type"]);
    exit;
}

if ($idExercise) {
    // Consulta para un ejercicio específico
    $query = "SELECT *
              FROM exercise e
              JOIN language l ON e.idLanguage = l.idLanguage
              WHERE e.idExercise = :idExercise
                AND e.type = :type
                AND l.name = :name";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idExercise', $idExercise, PDO::PARAM_INT);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $languageName);

    $stmt->execute();
    $exercise = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($exercise);
} else {
    // Consulta para todos los ejercicios del tipo y lenguaje
    $query = "SELECT *
              FROM exercise e
              JOIN language l ON e.idLanguage = l.idLanguage
              WHERE e.type = :type
                AND l.name = :name";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $languageName);

    $stmt->execute();
    $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($exercises);
}
?>
