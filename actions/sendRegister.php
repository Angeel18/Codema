<?php
session_start();
// actions/sendRegister.php
require_once '../config/bbdd_config.php';

header('Content-Type: application/json');

$db = createConnection();

// 1) Grab & sanitize
$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$nickname = trim($_POST['nickname'] ?? '');
$password = $_POST['password'] ?? '';
$email = trim($_POST['email'] ?? '');

// $plan = trim($_POST['sel-plan'] ?? '');
$plan = $_POST['sel-plan'] ;

$experience = 0;

$errors = [];

// 2) Basic validation (you can expand this)
if (!$name) {
    $errors['name'] = 'Required';
}
if (!$surname) {
    $errors['surname'] = 'Required';
}
if (!$nickname) {
    $errors['nickname'] = 'Required';
}
if (!$email) {
    $errors['email'] = 'Required';
}
if (!$password) {
    $errors['password'] = 'Required';
}

//if user cancel register and try to register again this part delete the previous register so user can have its original email

if (isset($_SESSION["idOrder"])) {
    $stmt55 = $db->prepare("SELECT idUser, state FROM purchase_orders WHERE idOrder = ?");
    $stmt55->execute([$_SESSION["idOrder"]]);
    $order55 = $stmt55->fetch(PDO::FETCH_ASSOC);

    // Only delete if the order is unpaid and the user exists
    if ($order55 && $order55['state'] === 'unpaid' && $order55['idUser']) {
        // Delete the order
        $db->prepare("DELETE FROM purchase_orders WHERE idOrder = ?")->execute([$_SESSION["idOrder"]]);
        // Delete the user only if they exist
        $db->prepare("DELETE FROM user WHERE idUser = ?")->execute([$order55['idUser']]);
    }

    unset($_SESSION["idOrder"]);
    // usleep(1000000);
}


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
      (name, surname, email, nickname, password,idPlan,experience) 
    VALUES 
      (?, ?, ?, ?, ?,?,?)
");
$ok = $insert->execute([
    $name,
    $surname,
    $email,
    $nickname,
    $hashedPassword,
    $plan,
    $experience,
]);

if (!$ok) {
    $errorInfo = $insert->errorInfo();
    echo json_encode(['error' => ['general' => 'Insert failed', 'details' => $errorInfo]]);
    exit;
}

if ($ok) {
    echo json_encode(['successful' => true]);
    $userId = $db->lastInsertId();
    // $_SESSION["id_user"] = $userId;


    // insert order si el plan es el gratis lo inserta como paid directamente
    if ($plan == 1) {
        $insert = $db->prepare("
    INSERT INTO `purchase_orders` 
      (idUser, idPlan,state) 
    VALUES 
      (?, ?,'paid')
    ");

        $orderOk = $insert->execute([
            $userId,
            $plan
        ]);
        
    $orderId = $db->lastInsertId();
    $_SESSION["idOrder"] = $orderId;


    } else {
        $insert = $db->prepare("
    INSERT INTO `purchase_orders` 
      (idUser, idPlan) 
    VALUES 
      (?, ?)
    ");

        $orderOk = $insert->execute([
            $userId,
            $plan
        ]);

    }


    $orderId = $db->lastInsertId();
    $_SESSION["idOrder"] = $orderId;

    if ($orderOk) {
        // plan price
        $stmt = $db->prepare("SELECT price FROM plan WHERE idPlan = ?");
        $stmt->execute([$plan]);
        $planData = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['plan_price'] = $planData['price'];
    }


} else {
    // catch-all for DB errors
    echo json_encode(['error' => ['general' => 'Database insert failed']]);
}
