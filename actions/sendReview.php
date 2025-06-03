<?php
session_start();
require_once '../config/bbdd_config.php';
header('Content-Type: application/json');

try {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['id_user'])) {
        throw new Exception('Usuario no autenticado');
    }

    // Obtener datos del POST (ahora viene como JSON)
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        throw new Exception('Datos inválidos');
    }

    $id_user = $_SESSION['id_user'];
    $valor = filter_var($data['rating'] ?? 0, FILTER_VALIDATE_FLOAT);
    $comentario = htmlspecialchars($data['comment'] ?? '', ENT_QUOTES, 'UTF-8');

    // Validaciones
    if ($valor < 0.5 || $valor > 5) {
        throw new Exception('La valoración debe estar entre 0.5 y 5');
    }

    if (empty($comentario)) {
        throw new Exception('El comentario no puede estar vacío');
    }

    // Conexión a la base de datos
    $db = createConnection();
    
    // Usar consultas preparadas correctamente para evitar SQL injection
    $stmt = $db->prepare("INSERT INTO reviews (idUser, valor, comentario) VALUES (?, ?, ?)");
    $r = $stmt->execute([$id_user, $valor, $comentario]);

    if ($r) {
        $response = [
            'success' => true,
            'message' => 'Reseña enviada correctamente'
        ];
    } else {
        throw new Exception('Error al ejecutar la consulta');
    }
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
} finally {
    // Cerrar conexión si existe
    if (isset($db)) {
        $db = null;
    }
}

echo json_encode($response);
exit;