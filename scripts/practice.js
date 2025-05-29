const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus = lan.toLowerCase();

const arrayTips = {
  Java: [
    "Remember to end each statement with a semicolon (;).",
    "Code must be inside a class, and the main method is public static void main(String[] args).",
    "Be case-sensitive: Java distinguishes between Variable and variable, so write names exactly the same every time.",
    "Do not compare objects with ==: Use .equals() to compare object content like strings; == only compares references.",
    "Watch array indices: Arrays and lists in Java start at 0, so the first element is array[0].",
    "Initialize your variables and objects before using them: Using an uninitialized object can cause a NullPointerException.",
    "Use comments to explain complex parts of your code: It helps you or others understand it later.",
    "Organize your code into small, specific methods: Avoid long methods; each one should do a single clear task.",
    "Handle exceptions properly: Use try-catch blocks to control errors and prevent your program from crashing unexpectedly."
  ],

  JavaScript: [
    "You can declare variables with let, const, or var, but prefer let and const to avoid errors.",
    "Semicolons (;) are optional, but using them helps prevent unexpected issues.",
    "JavaScript is case-sensitive, so write variable and function names exactly as intended.",
    "Be careful with dynamic typing: JavaScript automatically converts data types, which can cause unexpected results. Use === instead of == to compare both value and type.",
    "Don't forget error handling: Use try...catch to prevent unexpected errors from stopping your script.",
    "Declare your variables before using them: Avoid bugs by always declaring variables with let, const, or var.",
    "Avoid modifying objects or arrays directly: Use methods that return new copies to prevent side effects.",
    "Get familiar with arrow functions (()=>{}): They are a modern and concise way to write functions.",
    "Be careful with the context of this: The value of this can change depending on how you call a function; learn to manage it to avoid confusion."
  ],

  Python: [
    "Do not use semicolons at the end of lines; indentation (spaces at the start) defines code blocks.",
    "Keywords and variable names are case-sensitive.",
    "Always use the same amount of spaces for indentation (typically 4 spaces per level).",
    "Respect indentation: Python uses it to define code blocks; mixing spaces and tabs can cause errors.",
    "Do not use variables before assigning them a value: Python does not allow undefined variables.",
    "Remember that list and string indices start at 0: The first element is always at index 0.",
    "Use functions to avoid repeating code: If you're doing the same thing multiple times, create a function to reuse it.",
    "Take advantage of list comprehensions: They're an elegant and efficient way to create new lists from existing ones.",
    "Use descriptive names for variables and functions: It makes your code easier to read and maintain."
  ]
};



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
const languageTitle=document.getElementById("languageTitle");
const check = document.getElementById("check");
const tips = document.querySelectorAll("#tips li");

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
      languageTitle.textContent=lan;

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
  await loadTips();
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

async function loadTips(params) {
    const datos = arrayTips[lan] || [];
  const usados = [];

  for (let i = 0; i < tips.length; i++) {
    let rand;
    do {
      rand = Math.floor(Math.random() * datos.length);
    } while (usados.includes(rand) && datos.length > 1);
    usados.push(rand);
    tips[i].textContent = datos[rand] || "";
  }
  
}