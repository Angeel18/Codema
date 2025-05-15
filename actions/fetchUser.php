<?php
session_start();
require_once '../config/bbdd_config.php';
$pdo = createConnection();

// JOIN para obtener el nombre del lenguaje
$stmt = $pdo->prepare("SELECT user.*, language.name as languageName
from progress,exercise,user,language 
where progress.idExercise=exercise.idExercise and progress.idUser= user.idUser and exercise.idLanguage=language.idLanguage and user.idUser=:idUser;");

$stmt->bindParam(":idUser", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
