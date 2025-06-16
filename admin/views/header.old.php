<?php
/**
 * admin/header_admin.php
 * ------------------------------------------------------------
 * Dynamic admin navigation header: automatically lists all tables
 * in the connected database schema.
 * Requires a valid superuser session and db connection.
 * ------------------------------------------------------------
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../../config/bbdd_config.php';

$db = createConnection();

// Determine current schema
$schema = $db->query('SELECT DATABASE()')->fetchColumn();

// Fetch all table names in the schema
$stmt = $db->query("SHOW TABLES");
$tables = [];
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}
?>
<header class="admin-header">
    <a href="/" class="logo">Codema - <b>Admin Dashboard<b></b></a></nav>
    <nav class="admin-nav">
        <ul>
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
    </nav>
</header>