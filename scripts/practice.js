const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus = lan.toLowerCase();

// const type = params.get('Type');
const idExercise=params.get('idExercise');
// const daily = params.get('daily');

let data;
let editor;

function createEditor() {
require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs' } });

  return new Promise(resolve => {
    require(['vs/editor/editor.main'], function () {
      editor = monaco.editor.create(document.getElementById('editor-container'), {
        language: lanMinus,
        theme: 'vs-dark',
        automaticLayout: true
      });
      resolve();
    });
  });
}
// const select = document.getElementById("exercise");
const arrow = document.getElementById("extraContentArrow");
const panel = document.getElementById("extraContent");
const description = document.getElementById("description");
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


async function checkAnswer() {

  if (await checkTries()) {
  if(data.solution==editor.getValue()){
    //si llega aqui se inserta el progresso y suma puntos
    //recordatorio en la bbdd la combinacion usuario ejercicio en la tabla progreso es unica asi que si un usuario hace bien 2 veces el mismo ejercicio no insertara en progres la 2º asi que no se sumara puntos 2 veces
    //aun asi puede ejecutar y checkear el codigo
    try {
      let response2 = await fetch(`../actions/addPoints.php`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ idExercise: idExercise })
      });
      
      console.log("aaaa");
      let data5 = await response2.json();

      console.log(data5);

    }catch{
    }
      alert("\u2705 Correct!");

  }else{
      alert(`\u274C Incorrect`);
  }
}else{
    alert("You Exceed the number of tries for this exercise today");

}
}


async function initialize() {
  await createEditor(); 
  await fetchExcercise();
}

initialize();

import {runJavaCode , runJavascriptCode, runPythonCode ,runHtmlCode} from "./runCode.js";

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



async function checkTries() {
// console.log("sda");
  try {
    let response = await fetch(`../actions/countTries.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ idExercise:idExercise})

    });

    let check = await response.json();
    //si el usuario intenda hacceder a ejercicios por la url y pone una combinacion no valida como cargar un ej de teoria en la pantalla de practica le redirijira al selector de ejercicios
    // console.log(check)
    console.log(check[0]);
    if(check[0]<3){
      return true;
    }else{
      return false;
    }

  } catch (error) {
    console.error("Error en la petición:", error);
  }
}