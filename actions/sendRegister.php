<?php
session_start();
// actions/sendRegister.php
require_once '../config/bbdd_config.php';

header('Content-Type: application/json');

$db = createConnection();

// 1) Grab & sanitize
$name     = trim($_POST['name'] ?? '');
$surname  = trim($_POST['surname'] ?? '');
$nickname = trim($_POST['nickname'] ?? '');
$password = $_POST['password'] ?? '';
$email    = trim($_POST['email'] ?? '');

$errors = [];

// 2) Basic validation (you can expand this)
if (!$name)     { $errors['name']     = 'Required'; }
if (!$surname)  { $errors['surname']  = 'Required'; }
if (!$nickname) { $errors['nickname'] = 'Required'; }
if (!$email)    { $errors['email']    = 'Required'; }
if (!$password) { $errors['password'] = 'Required'; }

if (empty($errors)) {
    // 3) Check email uniqueness
    $stmt = $db->prepare("SELECT idUser FROM `user` WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $errors['email'] = 'already exists';
    }
    // 4) Check nickname uniqueness
    $stmt = $db->prepare("SELECT idUser FROM `user` WHERE nickname = ?");
    $stmt->execute([$nickname]);
    if ($stmt->fetch()) {
        $errors['nickname'] = 'already exists';
    }
}

if (!empty($errors)) {
    // 5) Return field‐specific errors
    echo json_encode(['error' => $errors]);
    exit;
}

// 6) All good — hash & insert
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$insert = $db->prepare("
    INSERT INTO `user` 
      (name, surname, email, nickname, password) 
    VALUES 
      (?, ?, ?, ?, ?)
");
$ok = $insert->execute([
    $name,
    $surname,
    $email,
    $nickname,
    $hashedPassword,
]);

if ($ok) {
    echo json_encode(['successful' => true]);
    $userId = $db->lastInsertId();
    $_SESSION["id_user"] = $userId;

} else {
    // catch-all for DB errors
    echo json_encode(['error' => ['general' => 'Database insert failed']]);
}
