<?php
session_start();
if (isset($_SESSION['is_superuser'])) {
session_destroy();
session_start();
}
$userId = !isset($_SESSION["id_user"]) ? exit() : $_SESSION["id_user"];
// session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="media/favicon.png">

    <title>Codema – Courses</title>
    <link rel="stylesheet" href="styles/homeStyles.css">
    <link rel="stylesheet" href="styles/theory.css">
    <link rel="stylesheet" href="styles/courses.css">
</head>

<body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
    ?>
    <div class="content">
        <div class="sidebar">
            <h2>Theory</h2>
            <div id="languageList"></div>
        </div>

        <div class="main">
            <div id="exerciseContainer">

            </div>
        </div>
    </div>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
    <script src="/scripts/fetchTheory.js"></script>

</body>

</html>