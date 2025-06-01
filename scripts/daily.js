let data;
let lanMinus;
let editor;
const check = document.getElementById("check");
const arrow = document.getElementById("extraContentArrow");
const panel = document.getElementById("extraContent");
const LanguageToCode = document.getElementById("LanguageToCode");
let idExercise;



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
    idExercise=data.idDaily;
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

     const code = editor.getValue();
  try {
    const response = await fetch(`../actions/checkWithAI.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ code: code , description:data.description,Language:lanMinus})
    });
    let check = await response.json();

    if (check=="RIGHT") {
          try {
      let response2 = await fetch(`../actions/addPoints.php`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({Table:"Daily", idExercise: idExercise })
      });
      
      // console.log("aaaa");
      let data5 = await response2.json();

      console.log(data5);

    }catch{
    }
     alert("\u2705 Correct!");


  }else{
      alert(`\u274C Incorrect`);
  }

  } catch (error) {
    console.error("Error en la petición:", error);
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



