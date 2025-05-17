<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dynamic Selector</title>
  <link rel="stylesheet" href="../styles/selector.css">
  <link rel="stylesheet" href="../styles/homeStyles.css">
</head>

<body>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php"); ?>

  <div class="center">
    <h2>Select Language and Exercise Mode</h2>

    <label for="languageSelect">Language:</label>
    <select id="languageSelect">
      <option value="">-- Select a language --</option>
    </select>

    <br><br>

    <label for="typeSelect">Exercise Mode:</label>
    <select id="typeSelect" disabled>
      <option value="">-- Select mode --</option>
    </select>

    <button id="goBtn">Go</button>
  </div>

  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html"); ?>
  <script src="../scripts/selector.js"></script>
</body>
</html>
