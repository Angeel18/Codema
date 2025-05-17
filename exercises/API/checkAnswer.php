<?php
// Conexión a la base de datos
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

// Obtener el content JSON del POST
$content = file_get_contents("php://input");
$data = json_decode($content, true);

// Extraer el valor específico
$idExercise = $data['ejercicio'] ?? null;
$input = $data['input'];
// print_r($data);

if ($idExercise === null) {
    http_response_code(400);
    echo "ID de ejercicio no proporcionado.";
    exit;
}

// Consulta
$ver = "SELECT * FROM exercise WHERE idExercise=:idExercise";
$stmt = $pdo->prepare($ver);
$stmt->bindParam(":idExercise", $idExercise);

$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result != null) {
    if ($result["solution"] == $input) {
        // En la bbdd la combinacion iduser-idexercise es unica, es decir un usuario NO puede hacer 2 vecer el mismo ejercicio e insertarse esas 2 veces en la tabla progress, asi que el siguiente bloque va en un trycatch
        try {
        // Insertar ejercicio hecho en la bbdd
        $date = date("Y-m-d H:i:s");
        $ver = "INSERT into progress(idUser,idExercise,doneDate) VALUES(:idUser,:idExercise,:doneDate)";
        $stmt = $pdo->prepare($ver);
        $stmt->bindParam(":idUser", $_SESSION['id_user']);
        $stmt->bindParam(":idExercise", $idExercise);
        $stmt->bindParam(":doneDate", $date);

        $stmt->execute();

        // sumar puntos
        $ver = "UPDATE user set experience = experience + 5 WHERE idUser=:idUser";
        $stmt = $pdo->prepare($ver);
        $stmt->bindParam(":idUser", $_SESSION['id_user']);
        $stmt->execute();

        } catch (\Throwable $th) {
            //throw $th;
        }

        
        echo true;

    } else {
        echo false;
    }
}

?>