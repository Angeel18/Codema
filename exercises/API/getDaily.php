<?php
session_start();
// Conexión a la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");

header('Content-Type: application/json');


$pdo = createConnection();

$stmt = $pdo->prepare("SELECT * from daily_exercises where exercise_date = CURDATE()");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result == null) {
    echo "Aun no hay ejercicio diario para hoy.";
} else {
    $stmt = $pdo->prepare("SELECT * from user_daily_exercises where idUser = :idUser and idDaily = :idDaily and completed = 1");
    $stmt->bindParam(":idUser", $_SESSION['id_user']);
    $stmt->bindParam(":idDaily", $result['idDaily']);

    $stmt->execute();
    $exercise = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($exercise != null) {
        echo json_encode(array("error" => "Ya has hecho el ejercicio de hoy."));
    } else {

        echo json_encode($result);
    }
}

