<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/config/bbdd_config.php");
$pdo = createConnection();

$userEmail = $_POST['emailSubscribe'] ?? '';

if ($userEmail && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    try {
        $stmt = $pdo->prepare("INSERT INTO newsletter(email) VALUES(:email)");
        $stmt->bindParam(':email', $userEmail);
        $stmt->execute();

        // Guardamos mensaje en sesión
        $_SESSION['subscribe_message'] = [
            'text' => 'Subscribed successfully',
            'type' => 'success'  // Podrías usar 'error' para otros casos
        ];

        // Redirige sin parámetros GET
        header("Location: /");
        exit;
    } catch (PDOException $e) {
        // Opcional: guardar error en sesión
        $_SESSION['subscribe_message'] = [
            'text' => 'This email is already subscribed.',
            'type' => 'error'
        ];
        header("Location: /");
        exit;
    }
} else {
    $_SESSION['subscribe_message'] = [
        'text' => 'Invalid email address.',
        'type' => 'error'
    ];
    header("Location: /");
    exit;
}

