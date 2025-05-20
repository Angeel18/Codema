let data;
// console.log("a");
const params = new URLSearchParams(window.location.search);
const lan = params.get('Language');
const lanMinus = lan.toLowerCase();
// const type = params.get('Type');
// const idExercise=params.get('idExercise'); 

async function fetchExcercise() {
  try {
    const response = await fetch(`../actions/fetchExercise.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ Type:"theory",Language:lan})
    });

    data = await response.json();
    //si el usuario intenda hacceder a ejercicios por la url y pone una combinacion no valida como cargar un ej de teoria en la pantalla de practica le redirijira al selector de ejercicios
    if(!data){
    window.location.href = `selectorView.php`;
    }else{
      // loadExcersice();
    }
  } catch (error) {
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
  buttonCheck.textContent="CHECK";
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

   const selectedExercise = data.find(ex => ex.idExercise == ejercicio);


  if (selected) {
    // Obtén el valor seleccionado
    const input = selected.value;

      if(selectedExercise.solution==input){
              feedback.textContent = "\u2705 Correct!";
        feedback.style.color = "green";
      }else{
       feedback.textContent = `\u274C Incorrect`;
        feedback.style.color = "red";
      }

  } else {
    feedback.textContent="No option selected.";
  }

  
}

async function initialize() {
  await fetchExcercise();
  loadExcersice();
}

initialize();