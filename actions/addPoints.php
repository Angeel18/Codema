<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$contenido = file_get_contents("php://input");
$data = json_decode($contenido, true);



$idUser=$_SESSION["id_user"];
$idExercise = $data['idExercise'] ?? null;
$table=$data["Table"];

//inserto en la tabla progress, en la bbdd hay un trigger que al insertar en esta tabla suma 5 ptos para ese usuario


if($table=="Exercise"){
    $stmt2 = $pdo->prepare("INSERT into progress(idUser,idExercise,doneDate) values(:idUser,:idExercise,CURDATE())");
$stmt2->bindParam(':idExercise', $idExercise);
$stmt2->bindParam(':idUser', $idUser);

$stmt2->execute();

}else if($table=="Daily"){
$stmt2 = $pdo->prepare("INSERT into user_daily_exercises(idUser,idDaily,completed) values(:idUser,:idExercise,true)");
$stmt2->bindParam(':idExercise', $idExercise);
$stmt2->bindParam(':idUser', $idUser);

$stmt2->execute();

}

?>