let data;
let lanMinus;
let editor;
const check = document.getElementById("check");
const arrow = document.getElementById("extraContentArrow");
const panel = document.getElementById("extraContent");
const LanguageToCode = document.getElementById("LanguageToCode");



arrow.addEventListener("click", () => {
  panel.classList.toggle("visible");
});
document.addEventListener("click", (e) => {
  if (panel.classList.contains("visible") && !panel.contains(e.target)) {
    panel.classList.remove("visible");
  }
});

check.addEventListener("click", checkWithAI);

async function dailyChallenge(){
  try {
    const response = await fetch(`../exercises/API/getDaily.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
    });

    data = await response.json();
    lanMinus=data.name.toLowerCase();
    // editor.setValue(data.extraField); 
    LanguageToCode.textContent="Language: "+data.name;
    document.getElementById("description").textContent=data.description;
  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

async function initialize() {
  await dailyChallenge();

  //pongo esto aqui porque si no puede no obtener el lenguage correctamente
    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs' } });
    
    require(['vs/editor/editor.main'], function () {
    editor = monaco.editor.create(document.getElementById('editor-container'), {
    // value: `nombre = input("¿Cómo te llamas? ")
    // print("Hola,", nombre)`,
    value: data.extra_field,
    language: lanMinus,
    theme: 'vs-dark',
    automaticLayout: true
  });

});
}

async function checkWithAI() {
  if (await checkTries()) {
     const code = editor.getValue();
  try {
    const response = await fetch(`../actions/checkWithAI.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ code: code , description:data.description,Language:lanMinus})
    });
    // console.log(data);

    let check = await response.json();
    //si el usuario intenda hacceder a ejercicios por la url y pone una combinacion no valida como cargar un ej de teoria en la pantalla de practica le redirijira al selector de ejercicios
    // console.log(check)
    if (check=="RIGHT") {

    
     alert("\u2705 Correct!");

  }else{
      alert(`\u274C Incorrect`);
  }

  } catch (error) {
    console.error("Error en la petición:", error);
  }
  }else{
    alert("You Exceed the number of tries for this exercise today");
  }
 
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
      body: JSON.stringify({ idExercise:40})

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