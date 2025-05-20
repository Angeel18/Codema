<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

// Aqui entra en la segunda llamada del JS selector, una vez has seleccionado el lenguaje en el select, esto carga el tipo de ejercicios disponibles para ese lenguaje
if (isset($data['idLanguage'])&&!isset($data['typeSelected'])) {
    $idLanguage = $data['idLanguage'];

    $stmt = $pdo->prepare("SELECT DISTINCT type FROM exercise WHERE idLanguage = :idLanguage");
    $stmt->bindParam(":idLanguage", $idLanguage, PDO::PARAM_INT);
    $stmt->execute();

    $types = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(["types" => $types]);
    exit;
}

//tercera consulta lista de ejercicios

if (isset($data['idLanguage'])&&isset($data['typeSelected'])) {
    $idLanguage = $data['idLanguage'];
    $typeSelect=$data['typeSelected'];

    $stmt = $pdo->prepare("SELECT l.name, e.*
    from exercise e 
    join language l 
    on e.idLanguage=l.idLanguage 
    where l.idLanguage=:idLanguage and e.type=:typeSelect");
    
    $stmt->bindParam(":idLanguage", $idLanguage, PDO::PARAM_INT);
    $stmt->bindParam(":typeSelect", $typeSelect);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
    exit;
}
// primera llamada del JS de selector, aqui carga las opcionoes de nombre de lenguajes 
$stmt = $pdo->query("SELECT idLanguage, name FROM language");
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(["languages" => $languages]);





?>