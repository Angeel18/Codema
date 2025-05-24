<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);

$idUser=$_SESSION["id_user"];
$idExercise = $data['idExercise'] ?? null;

//comprueba lols intentos de este usuario este dia para este ejercicio
$stmt = $pdo->prepare("SELECT COUNT(*) FROM tries WHERE idUser = :idUser AND idExercise = :idExercise AND tryDate =  CURDATE()");

$stmt->bindParam(':idExercise', $idExercise);
$stmt->bindParam(':idUser', $idUser);

$stmt->execute();

$result = $stmt->fetch();


//el usuario ha comprobado asi que se inserta en la bbdd, el valor que se devuelve del numero de intentos es el de antes de insertar el intento
$stmt2 = $pdo->prepare("INSERT into tries(idUser,idExercise,tryDate) values(:idUser,:idExercise,CURDATE())");
$stmt2->bindParam(':idExercise', $idExercise);
$stmt2->bindParam(':idUser', $idUser);

$stmt2->execute();



echo json_encode($result);

?>