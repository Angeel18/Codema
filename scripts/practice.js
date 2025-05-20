const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus = lan.toLowerCase();

// const type = params.get('Type');
const idExercise=params.get('idExercise');
const daily = params.get('daily');

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

// const select = document.getElementById("exercise");
const arrow = document.getElementById("extraContentArrow");
const panel = document.getElementById("extraContent");
const description = document.getElementById("description");
const resultContainer = document.getElementById('result-container');
const check = document.getElementById("check");

check.addEventListener("click", checkAnswer);
// select.addEventListener("change", loadExcersiceDetails);

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

    case "html":
  runHtmlCode(code);
  break;
  }
});


async function fetchExcercise() {
  try {
    const response = await fetch(`../actions/fetchExercise.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ idExercise: idExercise , Type:"practice",Language:lan})
    });

    data = await response.json();
    //si el usuario intenda hacceder a ejercicios por la url y pone una combinacion no valida como cargar un ej de teoria en la pantalla de practica le redirijira al selector de ejercicios
    if(!data){
    window.location.href = `selectorView.php`;
    }else{
      description.textContent = data.description;
      if (data.extraField != null) {
        editor.setValue(data.extraField); 
        }
    }
  } catch (error) {
    console.error("Error en la petición:", error);
  }
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
  console.clear();

  const resultContainer = document.getElementById('result-container');
  resultContainer.textContent = ''; // Limpiar resultados anteriores

  const originalConsoleLog = console.log;

  try {
    // Redefinir console.log para capturar salidas
    console.log = function (...args) {
      originalConsoleLog(...args); // También imprime en la consola real
      const message = args.join(' ');
      resultContainer.textContent += message + '\n';
    };

    eval(code); // Ejecutar el código del usuario

  } catch (error) {
    resultContainer.textContent += error + '\n';

  } finally {
    // Restaurar console.log al original
    console.log = originalConsoleLog;
  }
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
  if(data.solution==editor.getValue()){
      alert("\u2705 Correct!");

  }else{
      alert(`\u274C Incorrect`);
  }
}

async function runHtmlCode(code) {
  const resultContainer = document.getElementById('result-container');
  resultContainer.innerHTML = '<iframe id="html-preview" style="width:100%; height:100%; border:none;"></iframe>';

  const iframe = document.getElementById('html-preview');
  const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
  
  iframeDoc.open();
  iframeDoc.write(code);
  iframeDoc.close();
}



async function initialize() {
  await fetchExcercise();
}

initialize();