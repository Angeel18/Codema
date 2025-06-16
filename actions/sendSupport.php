<?php
// Recoge los datos del POST
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Importa la configuración de la base de datos
require_once __DIR__ . '/../config/bbdd_config.php';

// Crea la conexión
$pdo = createConnection();

// Prepara la consulta para insertar los datos en la tabla 'contact'
$sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
$stmt = $pdo->prepare($sql);

// Ejecuta la consulta con los datos recibidos
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':message' => $message
]);

// Opcional: puedes devolver una respuesta JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Datos enviados correctamente']);
