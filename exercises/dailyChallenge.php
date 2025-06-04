<?php
session_start();
$userId = !isset($_SESSION["id_user"]) ? header("location:../") : "" ;
if (isset($_SESSION['is_superuser'])) {
  session_destroy();
  session_start();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../media/favicon.png">

  <title>Codema – Daily Challenge</title>
  <link rel="stylesheet" href="/styles/homeStyles.css">
  <link rel="stylesheet" href="/styles/practice.css">
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
    Exercise Information
        <h1 class="logo">Codema</h1>
   
    <h2 id="LanguageToCode"></h2>
    <strong>
      <p id="description"></p>
    </strong>
    <ul id="tips">
      <!-- Mensajes por defecto, en el js los cambio -->
      <li>Write clear and readable code: Prioritize readability over complexity; simple code is easier to maintain and less prone to errors.</li>
      <li>Break problems into smaller parts: Tackle complex challenges by breaking them down into simple, manageable steps to make them easier to solve.</li>
      <li>Review and test your code regularly: Test frequently to catch errors early and ensure your solution works as expected.</li>
    </ul>

    <p>
      <strong>Remember</strong>
      Read the instructions carefully, think about the logic before writing code, and test your solution with different cases. If you get stuck, break the problem into small steps and review the basic syntax of the language. Don’t be afraid to make mistakes — every error is an opportunity to learn!
    </p>
  </div>
</div>


  <div class="buttonBox">
    <button id="run">RUN</button>
    <button id="check">CHECK</button>

  </div>

  <div id="input-container">
    <textarea id="user-input" placeholder="Your inputs go here..."></textarea>
  </div>

  <div id="container">
    <div id="editor-container"></div>
    <!-- <div id="separator"></div> -->
    <div id="result-container"></div>
  </div>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs/loader.min.js"></script>
  <!-- <script src="js/ejecutorPython.js"></script> -->
  <script  type="module" src="../scripts/daily.js" data-language=<?php $_GET["Language"]?>></script>

</body>

</html>