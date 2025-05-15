<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Selector Dinámico</title>
  <!-- <link rel="stylesheet" href="../styles/exercise.css"> -->
  <link rel="stylesheet" href="../styles/selector.css">
  <link rel="stylesheet" href="../styles/homeStyles.css">


</head>

<body>
  <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");

  ?>
<!-- <script src="/scripts/script.js"></script> -->
<div class="centrar">
  <h2>Selecciona Lenguaje y Tipo de Ejercicio</h2>
  <label for="languageSelect">Lenguaje:</label>
  <select id="languageSelect">
    <option value="">-- Selecciona un lenguaje --</option>
  </select>

  <br><br>

  <label for="typeSelect">Tipo de ejercicio:</label>
  <select id="typeSelect" disabled>
    <option value="">-- Selecciona tipo --</option>
  </select>
  <button id="irBtn">Ir al ejercicio</button>
  </div>

  <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>
  <script>
    const languageSelect = document.getElementById('languageSelect');
    const typeSelect = document.getElementById('typeSelect');

    // Cargar lenguajes al cargar la página
    window.addEventListener('DOMContentLoaded', async () => {
      try {
        const res = await fetch('selectorEjercicio.php');
        const data = await res.json();

        data.languages.forEach(lang => {
          const option = document.createElement('option');
          option.value = lang.idLanguage;
          option.textContent = lang.name;
          languageSelect.appendChild(option);
        });
      } catch (err) {
        console.error('Error al cargar lenguajes:', err);
      }
    });

    // Al cambiar lenguaje, cargar tipos
    languageSelect.addEventListener('change', async () => {
      const idLanguage = languageSelect.value;
      typeSelect.innerHTML = '<option value="">-- Selecciona tipo --</option>';
      typeSelect.disabled = true;

      if (!idLanguage) return;

      try {
        const res = await fetch('selectorEjercicio.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ idLanguage })
        });

        const data = await res.json();
        data.types.forEach(tipo => {
          const option = document.createElement('option');
          option.value = tipo;
          option.textContent = tipo.charAt(0).toUpperCase() + tipo.slice(1); // Capitaliza
          typeSelect.appendChild(option);
        });

        typeSelect.disabled = false;
      } catch (err) {
        console.error('Error al cargar tipos:', err);
      }
    });


    document.getElementById("irBtn").addEventListener("click", function () {
      const lenguaje = document.getElementById("languageSelect");
      const lenguajeTexto = lenguaje.options[lenguaje.selectedIndex].textContent;
      const tipo = document.getElementById("typeSelect").value;

      if (!lenguaje || !tipo) {
        alert("Selecciona ambos campos.");
        return;
      }

      // Normaliza el nombre para que coincida con tus carpetas
      const carpeta = lenguajeTexto.replace(/\s+/g, '');
      const archivo = tipo; // ejemplo: teoria.html o practica.html

      console.log(carpeta);
      console.log(archivo);

      // Redirige a la carpeta y archivo deseado
    //   window.location.href = `./${carpeta}/${archivo}`;
      window.location.href = `./${carpeta}/${archivo}?Language=${carpeta}&Type=${tipo}`;

    });

  </script>

</body>
</html>
