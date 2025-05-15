<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Progress</title>
  <link rel="stylesheet" href="styles/homeStyles.css" />
  <link rel="stylesheet" href="styles/progress.css" />

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php"); 
?>

<main class="progress-page container">
  <!-- Gráfica -->
  <canvas id="graph" width="400" height="400" style="background-color: white;"></canvas>

  <!-- Datos del usuario -->
  <div class="UserData">
    <h1 id="nickname">USER</h1>
    <p><strong>Exercises Done:</strong> <span id="exercises">--</span></p>
    <p><strong>Level:</strong> <span id="level">--</span></p>
    <p><strong>Experience:</strong> <span id="experience">--</span></p>
    <p><strong>Languages Studied:</strong> <span id="languages">--</span></p>
    <p><strong>Active Since:</strong> <span id="activeSince">--</span></p>
  </div>
</main>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html"); ?>

<!-- Scripts -->
<script src="scripts/progress.js"></script>

</body>
</html>
