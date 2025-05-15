let data;
const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus=lan.toLowerCase();
const type = params.get('Type');

async function fetchExcercise(){
    try {
      const response = await fetch(`../API/fetchExcercise.php`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ Language: lan, Type: type })
      });
      data = await response.json();
    }catch (error) {
      console.error("Error en la petición:", error);
    }
  }
  
async function loadExcersice() {
    try {

        const listDiv = document.getElementById('exerciseList');
        listDiv.textContent="";
    
        data.forEach(excercise => {
          const item = document.createElement('div');
          item.classList.add('exercise-item');
          item.setAttribute("value",excercise.idExercise);

          //MOSTRAR DESCRIPCION CORTADA
          item.textContent = excercise.description.substring(0, 60) + '...';
          item.addEventListener('click', () => loadExerciseDetail(item.getAttribute("value")));

          listDiv.appendChild(item);
        });
      } catch (error) {
        document.getElementById('exerciseList').textContent = "Error al cargar ejercicios.";
        console.error("Error:", error);
      }
} 

async function loadExerciseDetail(idExercise) {

  const container = document.getElementById('exerciseContainer');

  //limpiar contenedor
  while(container.firstChild){
    container.removeChild(container.firstChild);
  }
  const question=document.createElement("div");
  question.classList.add("question");

  const buttonCheck=document.createElement("button");
  buttonCheck.classList.add("btn");
  buttonCheck.textContent="COMPROBAR";
  buttonCheck.addEventListener("click", ()=>{checkAnswer(idExercise)});

  data.forEach(excercise => {
    if (excercise.idExercise==idExercise) {
      question.textContent=excercise.description;
      container.appendChild(question);
      //OPCIONES SEPARADAS POR ,
      let options=excercise.extraField.split(",");

      options.forEach(opt => {
        const option=document.createElement("div");
        option.classList.add("option");
        const input=document.createElement("input");
        input.value=opt;
        input.type="radio";
        input.name="option";
        // input.textContent=opt;
        const label=document.createElement("label");
        label.textContent=opt;
        
        option.appendChild(input);
        option.appendChild(label);
        container.appendChild(option);    
        });
        
    }
  });
    container.appendChild(buttonCheck);
}

async function checkAnswer(ejercicio) {
  const selected = document.querySelector('input[name="option"]:checked');
  const feedback=document.getElementById("feedback");
  if (selected) {
    // Obtén el valor seleccionado
    const input = selected.value;
    try {
      const response = await fetch("../API/checkAnswer.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({input,ejercicio}) //le paso los parametros de codigo y ejercicio al php
      });
      const data = await response.text();
      // alert(data);
      if(data){
        // alert("");
        feedback.textContent = "\u2705 ¡Correcto!";
        feedback.style.color = "green";
      }else{
        feedback.textContent = `\u274C Incorrecto`;
        feedback.style.color = "red";
      }

    } catch (error) {
      console.error("Error en la petición:", error);
    }
  } else {
    feedback.textContent="No se seleccionó ninguna opción.";
  }

  
}

async function initialize() {
  await fetchExcercise();
  loadExcersice();
}

initialize();