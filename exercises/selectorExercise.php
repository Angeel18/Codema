<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

// Si se recibe idLanguage, devolvemos tipos
if (isset($data['idLanguage'])) {
    $idLanguage = $data['idLanguage'];

    $stmt = $pdo->prepare("SELECT DISTINCT type FROM exercise WHERE idLanguage = :idLanguage");
    $stmt->bindParam(":idLanguage", $idLanguage, PDO::PARAM_INT);
    $stmt->execute();

    $tipos = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(["types" => $tipos]);
    exit;
}

// Si no se recibe nada, devolvemos todos los lenguajes
$stmt = $pdo->query("SELECT idLanguage, name FROM language");
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(["languages" => $languages]);

?>