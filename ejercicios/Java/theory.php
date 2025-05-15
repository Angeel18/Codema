<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ejercicios Teóricos</title>
  <link rel="stylesheet" href="../../styles/homeStyles.css">
  <link rel="stylesheet" href="../../styles/theory.css">

  
</head>
<body>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
  ?>
   <div class="content">
  <div class="sidebar">
    <h2>Ejercicios Teóricos</h2>
    <div id="exerciseList">Cargando ejercicios...</div>
  </div>
  <div class="main">
    <div id="exerciseContainer">
      <p>Selecciona un ejercicio de la izquierda para comenzar.</p>
    </div>

    
    <div id="feedback"></div>
  </div>
  </div>
  <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
  <script src="../../scripts/theory.js" data-language="java"></script>

</body>
</html>
