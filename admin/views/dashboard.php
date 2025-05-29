<?php
session_start();
require_once '../../config/bbdd_config.php';

// -- superuser check
if (!isset($_SESSION['is_superuser']) || $_SESSION['is_superuser'] !== true) {
    header('Location: ../login_admin.php');
    exit;
}

// -- DB & schema setup
$db     = createConnection();
// **1. Turn on exception mode**
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$schema = 'codema';

// -- fetch all tables dynamically
$stmt   = $db->query("SHOW TABLES FROM `$schema`");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

// -- determine which table to manage (default = first in the list)
$table = $_GET['table'] ?? $tables[0];
if (!in_array($table, $tables, true)) {
    // redirect to a valid table if someone tampers
    header('Location: ?table=' . urlencode($tables[0]));
    exit;
}

// -- handle CRUD POSTs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $tbl    = $_POST['table']  ?? '';
    if ($tbl === $table) {
        // grab columns + PK (unchanged)
        $desc = $db->prepare("DESCRIBE `$schema`.`$tbl`");
        $desc->execute();
        $cols = $desc->fetchAll(PDO::FETCH_ASSOC);
        $pk   = null;
        foreach ($cols as $col) {
            if ($col['Key'] === 'PRI') {
                $pk = $col['Field'];
                break;
            }
        }

        // UPDATE
        if ($action === 'update' && $pk) {
            $pk_val = $_POST['pk_val'];
            $sets   = [];
            $params = [];
            foreach ($cols as $col) {
                $f = $col['Field'];
                if ($f === $pk) continue;

                // password hashing on edit
                if ($f === 'password') {
                    $raw = $_POST[$f] ?? '';
                    if ($raw !== '') {
                        $sets[]   = "`$f` = ?";
                        $params[] = password_hash($raw, PASSWORD_DEFAULT);
                    }
                    continue;
                }

                $sets[]   = "`$f` = ?";
                $params[] = $_POST[$f] ?? null;
            }
            $params[] = $pk_val;
            $sql      = sprintf(
                "UPDATE `%s`.`%s` SET %s WHERE `%s` = ?",
                $schema, $tbl, implode(', ', $sets), $pk
            );
            $db->prepare($sql)->execute($params);
        }
        // DELETE
        elseif ($action === 'delete' && $pk) {
            $db->prepare(
                sprintf(
                    "DELETE FROM `%s`.`%s` WHERE `%s` = ?",
                    $schema, $tbl, $pk
                )
            )->execute([$_POST['pk_val']]);
        }
        // INSERT (skip auto_increment & CURRENT_TIMESTAMP defaults; omit empty fields)
        elseif ($action === 'insert') {
            $fields       = [];
            $placeholders = [];
            $params       = [];

            foreach ($cols as $col) {
                $f = $col['Field'];

                // omit auto_increment and CURRENT_TIMESTAMP defaults
                if ($col['Extra'] === 'auto_increment'
                    || strtoupper(($col['Default'] ?? '')) === 'CURRENT_TIMESTAMP'
                ) {
                    continue;
                }

                // get raw value and trim whitespace
                $raw = $_POST[$f] ?? '';
                $val = trim($raw);

                // if empty after trim, skip this field entirely
                if ($val === '') {
                    continue;
                }

                // handle password field: always hash if not empty
                if ($f === 'password') {
                    $fields[]       = "`$f`";
                    $placeholders[] = '?';
                    $params[]       = password_hash($val, PASSWORD_DEFAULT);
                    continue;
                }

                // all other non-empty fields
                $fields[]       = "`$f`";
                $placeholders[] = '?';
                $params[]       = $val;
            }

            // if no fields to insert, show alert
            if (empty($fields)) {
                echo "<script>alert('No hay datos para insertar.');</script>";
            } else {
                $sql = sprintf(
                    "INSERT INTO `%s`.`%s` (%s) VALUES (%s)",
                    $schema, $tbl,
                    implode(', ', $fields),
                    implode(', ', $placeholders)
                );
                try {
                    $db->prepare($sql)->execute($params);
                    header('Location: ?table=' . urlencode($table));
                    exit;
                } catch (PDOException $e) {
                    $msg = addslashes($e->getMessage());
                    echo "<script>alert('Insert failed: {$msg}');</script>";
                }
            }
        }
    } else {
        // if table mismatch, redirect
        header('Location: ?table=' . urlencode($tables[0]));
        exit;
    }
}

// -- fetch columns + data for display
$desc = $db->prepare("DESCRIBE `$schema`.`$table`");
$desc->execute();
$cols = $desc->fetchAll(PDO::FETCH_ASSOC);
$pk   = null;
foreach ($cols as $c) {
    if ($c['Key'] === 'PRI') {
        $pk = $c['Field'];
        break;
    }
}
$rows = $db->query("SELECT * FROM `$schema`.`$table`")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin: <?= htmlspecialchars($table) ?></title>
    <link rel="stylesheet" href="../../styles/homeStyles.css">
  <link rel="icon" type="image/png" href="../../media/favicon.png">
    <link rel="stylesheet" href="../../styles/auth.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>
<body>
    <?php require_once './header.php'; ?>
    <main style="min-height: 100vh;">
        <h1>Table: <?= htmlspecialchars($table) ?></h1>

        <table>
            <thead>
                <tr>
                    <?php foreach ($cols as $c): ?>
                        <th><?= htmlspecialchars($c['Field']) ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <form action="?table=<?= urlencode($table) ?>" method="post" class="inline">
                            <?php foreach ($cols as $c):
                                $f = $c['Field']; ?>
                                <td>
                                    <input type="text" name="<?= htmlspecialchars($f) ?>"
                                           value="<?= htmlspecialchars($row[$f]) ?>">
                                </td>
                            <?php endforeach; ?>
                            <td class="actions">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="table"  value="<?= htmlspecialchars($table) ?>">
                                <input type="hidden" name="pk_val" value="<?= htmlspecialchars($row[$pk]) ?>">
                                <button type="submit" class="icon-button save" title="Save">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                        </form>
                        <form action="?table=<?= urlencode($table) ?>" method="post" class="inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="table"  value="<?= htmlspecialchars($table) ?>">
                            <input type="hidden" name="pk_val" value="<?= htmlspecialchars($row[$pk]) ?>">
                            <button type="submit"
                                    class="icon-button delete"
                                    title="Delete"
                                    onclick="return confirm('Delete this record?');">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Add new record:</h3>
        <form action="?table=<?= urlencode($table) ?>" method="post" class="inline">
            <?php foreach ($cols as $c):
                // skip auto-increment & CURRENT_TIMESTAMP cols
                if ($c['Extra'] === 'auto_increment'
                    || strtoupper(($c['Default'] ?? '')) === 'CURRENT_TIMESTAMP'
                ) {
                    continue;
                }
                $f = $c['Field']; ?>
                <input type="text"
                       name="<?= htmlspecialchars($f) ?>"
                       placeholder="<?= htmlspecialchars($f) ?>">
            <?php endforeach; ?>
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="table"  value="<?= htmlspecialchars($table) ?>">
            <button type="submit" class="submit">Insert</button>
        </form>

        <a href="dashboard.php" class="back">&larr; Back to all tables</a>
    </main>
</body>
</html>
