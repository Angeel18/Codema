<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Codema – Theoretical exercises</title>
  <link rel="stylesheet" href="../../styles/homeStyles.css">
  <link rel="stylesheet" href="../../styles/theory.css">

</head>
<body>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
  ?>
   <div class="content">
  <div class="sidebar">
    <h2>Theoretical exercises</h2>
    <div id="exerciseList">Loading Exercises...</div>
  </div>
  <div class="main">
    <div id="exerciseContainer">
      <p>
Select an exercise from the left to begin.</p>
    </div>

    <div id="feedback"></div>
  </div>
  </div>
  <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
   <script src="../scripts/theory.js" data-language=<?php $_GET["Language"]?>></script>


</body>
</html>
