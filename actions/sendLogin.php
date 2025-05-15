<?php
session_start();
// actions/sendLogin.php
require_once '../config/bbdd_config.php';

header('Content-Type: application/json');

$db = createConnection();

// 1) Grab & sanitize
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$errors = [];

// 2) Basic validation
if (!$email) {
    $errors['email'] = 'Required';
}
if (!$password) {
    $errors['password'] = 'Required';
}

if (empty($errors)) {
    // 3) Look up user by email
    $stmt = $db->prepare("SELECT idUser, password FROM `user` WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $errors['email'] = 'Email not found';
    } else {
        // 4) Verify password
        if (!password_verify($password, $user['password'])) {
            $errors['password'] = 'Incorrect password';
        }
    }
}

if (!empty($errors)) {
    echo json_encode(['error' => $errors]);
    exit;
}

// 5) Success! Return userId (and any other data you want)
echo json_encode([
    'successful' => true,
    'userId'     => (int)$user['idUser']
]);

$_SESSION["id_user"] = $user['idUser'];
