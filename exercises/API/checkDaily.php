<?php
session_start();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// Conexión a la base de datos
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");


$pdo = createConnection();

$stmt = $pdo->prepare("SELECT * from daily_exercises where exercise_date = CURDATE()");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * from user_daily_exercises where idUser = :idUser and idDaily = :idDaily and completed = 0");
$stmt->bindParam(":idUser", $_SESSION['id_user']);
$stmt->bindParam(":idDaily", $result['idDaily']);

$stmt->execute();
$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
if ($exercise != null) {
    echo json_encode(array("error" => "Ya has hecho el ejercicio de hoy."));
} else {
    // Fetch the contents from getDaily.php using cURL
    $ch = curl_init("getDaily.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
