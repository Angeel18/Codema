<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../../config/bbdd_config.php';

$db = createConnection();
$schema = $db->query('SELECT DATABASE()')->fetchColumn();
$stmt = $db->query("SHOW TABLES");
$tables = [];
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard Header</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #292653;
            --secondary-color: #709ad0;
            --background-color: #222842;
            --header-footer-bg: #191f3b;
            --text-color: #ffffff;
            --accent-color: #6812b8;
            --success-color: #6f7eff;
        }
        body {
            font-family: 'Poppins', 'Segoe UI', 'Inter', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.7;
            overflow-x: hidden;
        }
        header {
            background: var(--header-footer-bg);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary-color);
            letter-spacing: -0.5px;
            text-decoration: none;
        }
        .nav-container {
            flex: 1 1 auto;
            display: flex;
            align-items: center;
            min-width: 0;
            position: relative;
            justify-content: right;
        }
        .nav-list {
            display: flex;
            gap: 1.75rem;
            list-style: none;
            align-items: center;
            margin: 0;
            padding: 0;
            white-space: nowrap;
        }
        .nav-list li {
            padding: 0.5rem;
        }
        .nav-list li a {
            font-weight: 500;
            transition: color 0.25s;
            color: var(--text-color);
            border-radius: 0.4rem;
            padding: 0.5rem 1rem;
            display: block;
        }
        .nav-list li a.active,
        .nav-list li a:hover {
            color: var(--secondary-color);
            background: rgba(112,154,208,0.09);
        }
        /* Hamburger */
        .hamburger-group {
            position: relative;
            display: flex;
            align-items: center;
        }
        .hamburger {
            height: 50px;
            width: 50px;
            margin-left: 1rem;
            position: relative;
            background-color: var(--header-footer-bg);
            border: none;
            display: none;
            cursor: pointer;
            z-index: 1100;
        }
        .hamburger span {
            height: 5px;
            width: 32px;
            background-color: var(--secondary-color);
            border-radius: 25px;
            position: absolute;
            left: 9px;
            transition: .3s ease;
        }
        .hamburger span:nth-child(1) { top: 15px; }
        .hamburger span:nth-child(2) { top: 23px; }
        .hamburger span:nth-child(3) { top: 31px; }
        .hamburger.active span:nth-child(1) {
            top: 23px;
            transform: rotate(45deg);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        .hamburger.active span:nth-child(3) {
            top: 23px;
            transform: rotate(-45deg);
        }
        /* Dropdown as child of header */
        .burger-dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            left: auto;
            background: var(--header-footer-bg);
            border: none;
            min-width: 220px;
            z-index: 1201; /* mayor que el header */
            border-radius: 0 0 12px 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.25);
            max-height: 60vh;
            overflow-y: auto;
            padding: 0.5rem 0;
        }
        .burger-dropdown.open {
            display: block;
        }
        .burger-dropdown ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .burger-dropdown li {
            width: 100%;
        }
        .burger-dropdown li a {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 0.7rem 1.2rem;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 0;
            text-align: left;
            transition: background 0.2s, color 0.2s;
            border-bottom: 1px solid rgba(112,154,208,0.06);
        }
        .burger-dropdown li:last-child a {
            border-bottom: none;
        }
        .burger-dropdown li a.active,
        .burger-dropdown li a:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
        }
        /* Responsive: mostrar hamburguesa si hace falta */
        @media (max-width: 900px) {
            .hamburger { display: block; }
        }
    </style>
</head>
<body>
<header id="main-header">
    <a href="/" class="logo">Codema - <b>Admin Dashboard</b></a>
    <nav class="nav-container" id="admin-nav">
        <ul class="nav-list" id="admin-nav-list">
            <?php foreach ($tables as $t): ?>
                <?php $label = ucfirst(str_replace('_', ' ', $t)); ?>
                <li>
                    <a href="dashboard.php?table=<?= urlencode($t) ?>"
                       class="<?= (isset($_GET['table']) && $_GET['table'] === $t) ? 'active' : '' ?>">
                        <?= htmlspecialchars($label) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="hamburger-group">
            <button class="hamburger" id="burger-btn" aria-label="Menú">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>
    <!-- El dropdown ahora es hijo directo del header -->
    <div class="burger-dropdown" id="burger-dropdown">
        <ul id="burger-list"></ul>
    </div>
</header>
<script>
(function() {
    const nav = document.getElementById('admin-nav');
    const navList = document.getElementById('admin-nav-list');
    const burgerBtn = document.getElementById('burger-btn');
    const burgerDropdown = document.getElementById('burger-dropdown');
    const burgerList = document.getElementById('burger-list');
    const TOLERANCE = 90;

    function updateMenu() {
        while (burgerList.firstChild) {
            navList.appendChild(burgerList.firstChild);
        }
        burgerDropdown.classList.remove('open');
        burgerBtn.classList.remove('active');
        burgerBtn.style.display = 'none';

        if ((navList.scrollWidth + TOLERANCE) <= nav.offsetWidth) return;

        let items = Array.from(navList.children);
        while ((navList.scrollWidth + TOLERANCE) > nav.offsetWidth && items.length) {
            burgerList.insertBefore(items.pop(), burgerList.firstChild);
            burgerBtn.style.display = 'block';
        }
    }

    burgerBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        burgerDropdown.classList.toggle('open');
        burgerBtn.classList.toggle('active');
    });
    document.addEventListener('click', function() {
        burgerDropdown.classList.remove('open');
        burgerBtn.classList.remove('active');
    });

    window.addEventListener('resize', updateMenu);
    window.addEventListener('DOMContentLoaded', updateMenu);
})();
</script>
</body>
</html>
