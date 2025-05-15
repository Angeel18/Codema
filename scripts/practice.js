const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus = lan.toLowerCase();
const type = params.get('Type');
let data;

require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs' } });
let editor;
require(['vs/editor/editor.main'], function () {
  editor = monaco.editor.create(document.getElementById('editor-container'), {
    // value: `nombre = input("¿Cómo te llamas? ")
    // print("Hola,", nombre)`,
    language: lanMinus,
    theme: 'vs-dark',
    automaticLayout: true
  });

});

const select = document.getElementById("exercise");
const arrow = document.getElementById("extraContentArrow");
const panel = document.getElementById("extraContent");
const description = document.getElementById("description");
const resultContainer = document.getElementById('result-container');
const check = document.getElementById("check");

check.addEventListener("click", checkAnswer);
select.addEventListener("change", loadExcersiceDetails);

arrow.addEventListener("click", () => {
  panel.classList.toggle("visible");
});

document.addEventListener("click", (e) => {
  if (panel.classList.contains("visible") && !panel.contains(e.target)) {
    panel.classList.remove("visible");
  }
});
document.getElementById("run").addEventListener('click', () => {
  const code = editor.getValue();

  switch (lanMinus) {
    case "python":
      runPythonCode(code);
      break;

    case "java":
      runJavaCode(code);
      break;

    case "javascript":
      runJavascriptCode(code);
      break;
  }
});


async function fetchExcercise() {
  try {
    const response = await fetch(`../API/fetchExcercise.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ Language: lan, Type: type })
    });
    data = await response.json();
  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

async function loadExcersice() {
  let i = 1;
  data.forEach(excercise => {
    const option = document.createElement("option");
    option.value = excercise.idExercise;
    option.textContent = i;
    i++;
    select.appendChild(option);
  });
}

async function loadExcersiceDetails() {
  const valorSeleccionado = select.value;
  data.forEach(exercise => {
    if (exercise.idExercise == valorSeleccionado) {
      if (exercise.extraField != null) {
        editor.setValue(exercise.extraField);
      }

      description.textContent = exercise.description;
    }
  })

}

async function runPythonCode(code) {
  resultContainer.textContent = ''; // Limpiar resultados anteriores
  const input = document.getElementById('user-input').value;
  // console.log("a");
  try {
    const response = await fetch('compiladorPython.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ code, input })
    });

    const result = await response.text();
    resultContainer.textContent = result;
  } catch (error) {
    resultContainer.textContent = 'Error al enviar código al servidor:\n' + error;
  }
}

async function runJavascriptCode(code) {
  const originalConsoleLog = console.log;
  console.log = function (...args) {
    originalConsoleLog(...args);
    const resultContainer = document.getElementById('result-container');
    const message = args.join(' ');
    resultContainer.textContent += message + '\n';
  };

  // const code = editor.getValue();
  const resultContainer = document.getElementById('result-container');
  resultContainer.textContent = ''; // Limpiar resultados anteriores
  try {
    eval(code);
  } catch (error) {
    resultContainer.textContent += error + '\n';
  }
  // console.log(code);

}

async function runJavaCode(code) {
  resultContainer.textContent = ''; // Limpiar resultados anteriores
  const input = document.getElementById('user-input').value;

  try {
    const response = await fetch('compiladorJava.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ code, input }) // Enviar código e input
    });

    const result = await response.text();
    resultContainer.textContent = result;
  } catch (error) {
    resultContainer.textContent = 'Error al enviar código al servidor:\n' + error;
  }
}

async function checkAnswer() {
  let input = editor.getValue();
  let ejercicio = select.value;
  try {
    const response = await fetch("../API/checkAnswer.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ input, ejercicio }) //le paso los parametros de codigo y ejercicio al php
    });

    const data = await response.text();
    // alert(data);

    if (data) {
      // alert("");
      alert("\u2705 ¡Correcto!");
      

    } else {
      alert(`\u274C Incorrecto`);
    }

  } catch (error) {
    console.error("Error en la petición:", error);
  }
}


async function initialize() {
  await fetchExcercise();
  loadExcersice();
}

initialize();