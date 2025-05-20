const languageSelect = document.getElementById('languageSelect');
const typeSelect = document.getElementById('typeSelect');
const exerciseSelect = document.getElementById('exerciseSelect');
let idLanguage;
let typeSelected;

const goBtn = document.getElementById('goBtn');

// Primera llamada a SelectorExercise.php, carga los posibles lenguajes
window.addEventListener('DOMContentLoaded', async () => {
  try {
    const res = await fetch('../actions/selectorExercise.php');
    const data = await res.json();

    data.languages.forEach(lang => {
      const option = document.createElement('option');
      option.value = lang.idLanguage;
      option.textContent = lang.name;
      languageSelect.appendChild(option);
    });
  } catch (err) {
    console.error('Failed to load languages:', err);
  }
});

// Segunda llamada a SelectorExercise.php, para cargar el tipo de ejercicio
languageSelect.addEventListener('change', async () => {
   idLanguage = languageSelect.value;

  // Remove all existing options except the first one
  while (typeSelect.options.length > 1) {
    typeSelect.remove(1);
  }

  typeSelect.disabled = true;

  if (!idLanguage) return;

  try {
    const res = await fetch('../actions/selectorExercise.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ idLanguage })
    });

    const data = await res.json();

    data.types.forEach(type => {
      const option = document.createElement('option');
      option.value = type;
      option.textContent = type.charAt(0).toUpperCase() + type.slice(1);
      typeSelect.appendChild(option);
    });

    typeSelect.disabled = false;

  } catch (err) {
    console.error('Failed to load exercise types:', err);
  }
});


typeSelect.addEventListener('change', async () => {
   typeSelected = typeSelect.value;
    exerciseSelect.style.display="none";

   if (typeSelected=="practice") {
    
  // Remove all existing options except the first one
  while (exerciseSelect.options.length > 1) {
    exerciseSelect.remove(1);
  }
  exerciseSelect.disabled = true;
  // if (!idLanguage) return;
// console.log(typeSelected);
  try {
      const resEx = await fetch('../actions/selectorExercise.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ idLanguage,typeSelected })
    });

    const dataEx = await resEx.json();

    let cont=1;
    dataEx.forEach(exercise => {
      const option = document.createElement('option');
      option.value = exercise.idExercise;
      option.textContent = cont+".- "+exercise.description.slice(0, 30)+"...";
     
      // console.log(exercise);
      cont++;
      exerciseSelect.appendChild(option);
    });
  } catch (err) {
    console.error('Failed to load languages:', err);
  }
    exerciseSelect.disabled = false;
    exerciseSelect.style.display="block";

   }

});

// Hace la redireccion
goBtn.addEventListener('click', () => {
  // console.log();
  const selectedLanguageOption =languageSelect.options[languageSelect.selectedIndex].textContent;
  const selectedType = typeSelect.value;
  const selectedExercise=exerciseSelect.value;

  if (!selectedLanguageOption || !selectedType || (!selectedExercise && selectedType=="practice")) {
    alert("Please select all fields.");
    return;
  }

let url = `./${selectedType}?Language=${selectedLanguageOption}`;

if (selectedType.toLowerCase() === 'practice') {
  url += `&idExercise=${exerciseSelect.value}`;
}

window.location.href = url;
});
