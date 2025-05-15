<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editor Python con Monaco</title>
  <link rel="stylesheet" href="../../styles/homeStyles.css">
  <link rel="stylesheet" href="../../styles/practice.css">
</head>

<body>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
  ?>

<div class="extraContent" id="extraContent">
  <div class="extraContentArrow" id="extraContentArrow">
    <svg id="arrowIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
      class="bi bi-chevron-double-left" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
      <path fill-rule="evenodd"
        d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
    </svg>
  </div>

  <div class="extraContentInner">
    Informacion Ejercicio
    <p id="description"></p>
  </div>
</div>


  <div class="botonera">
    <button id="run">EJECUTAR</button>
    <button id="check">Comprobar</button>

    <select name="" id="exercise">
      <option value="" selected disabled hidden>Ejercicio</option>
    </select>
  </div>

  <div id="input-container">
    <textarea id="user-input" placeholder="Introduce la entrada aquí..."></textarea>
  </div>

  <div id="container">
    <div id="editor-container"></div>
    <div id="separator"></div>
    <div id="result-container"></div>
  </div>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.min.js"></script>
  <!-- <script src="js/ejecutorPython.js"></script> -->
  <script src="../../scripts/practice.js" data-language="python"></script>

</body>

</html>