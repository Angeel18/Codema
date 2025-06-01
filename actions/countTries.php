<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

$idUser = $_SESSION["id_user"];
$idExercise = $data['idExercise'] ?? null;

$table = $data["Table"];

//vidas
    $stmt = $pdo->prepare("SELECT p.lifes
        from plan p join user u
        on u.idPlan=p.idPlan
        where u.idUser=:idUser");

    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $userLifesRow = $stmt->fetch();
    $userLifes = $userLifesRow['lifes'];

    // Contar intentos
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tries WHERE idUser = :idUser AND idExercise = :idExercise AND tryDate =  CURDATE()");
    $stmt->bindParam(':idExercise', $idExercise);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $resultRow = $stmt->fetch();
    $triesToday = $resultRow[0]; // Extraemos el conteo

    // Comparar
    if ($triesToday < $userLifes) {
        // Permitir intento
        $stmt2 = $pdo->prepare("INSERT into tries(idUser,idExercise,tryDate) values(:idUser,:idExercise,CURDATE())");
        $stmt2->bindParam(':idExercise', $idExercise);
        $stmt2->bindParam(':idUser', $idUser);
        $stmt2->execute();
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }

?>