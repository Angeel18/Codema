<?php
/**
 * admin/login_admin.php
 * ------------------------------------------------------------
 * Admin‑only login page.
 * ------------------------------------------------------------
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

require_once '../config/bbdd_config.php';


// If already logged‑in as superuser, skip the form
if (isset($_SESSION['is_superuser']) && $_SESSION['is_superuser'] === true) {
            header('Location: ./views/dashboard.php'); // e.g. admin/dashboard
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = createConnection();

    // Grab & basic sanitise
    $username    = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $error = 'username and password are required.';
    } else {
        // Fetch user – must be marked as superUser
        $stmt = $db->prepare("SELECT idAdmin, password, username FROM `admin` WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($password, $user['password'])) {
            $error = 'Incorrect password';
        } else {
            // ✅ Success … set session & redirect
            $_SESSION['id_user']      = (int)$user['idAdmin'];
            $_SESSION['is_superuser'] = true;

            header('Location: ./views/dashboard.php'); // e.g. admin/dashboard
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codema – Admin Login</title>
    <!-- Re‑use existing fonts & core styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/homeStyles.css">
    <link rel="stylesheet" href="../styles/auth.css">
    <style>
        /* Minor tweak for error box */
        .error‑box {
            background:#ffe6e6;
            color:#c0392b;
            border:1px solid #c0392b;
            padding:0.75rem 1rem;
            margin‑bottom:1rem;
            border‑radius:8px;
            font‑weight:500;
            text‑align:center;
        }
    </style>
</head>
<body>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>

<section class="auth-section">
    <div class="container">
        <h2 class="section-title">Admin Login</h2>

        <?php if ($error): ?>
            <div class="error‑box"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form class="auth-form" action="" method="post">
            <label for="admin-username">Username</label>
            <input type="username" id="admin-username" name="username" placeholder="" required>

            <label for="admin-password">Password</label>
            <input type="password" id="admin-password" name="password" placeholder="" required>

            <button type="submit" class="btn">Enter Admin Area</button>
        </form>
    </div>
</section>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.html'); ?>
</body>
</html>
