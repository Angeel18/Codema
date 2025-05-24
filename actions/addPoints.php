<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);



$idUser=$_SESSION["id_user"];
$idExercise = $data['idExercise'] ?? null;

// print_r($_SESSION);
// $idUser=5;
// $idExercise=40;
// echo json_encode($idExercise);

// echo($idExercise);

//inserto en la tabla progress, en la bbdd hay un trigger que al insertar en esta tabla suma 5 ptos para ese usuario

$stmt2 = $pdo->prepare("INSERT into progress(idUser,idExercise,doneDate) values(:idUser,:idExercise,CURDATE())");
$stmt2->bindParam(':idExercise', $idExercise);
$stmt2->bindParam(':idUser', $idUser);

$stmt2->execute();



?>