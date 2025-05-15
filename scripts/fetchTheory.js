let data = [];

async function fetchTheory() {
  try {
    const response = await fetch(`actions/fetchTheory.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" }
    });
    data = await response.json();
    // console.log(data); // Descomenta para depuración si lo necesitas
  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

//funcion para no mostrar datos repetidos
function uniqueByKey(arr, key) {
  const seen = new Set();
  return arr.filter(item => {
    if (seen.has(item[key])) return false;
    seen.add(item[key]);
    return true;
  });
}

function removeOpenMenus() {
  document.querySelectorAll('.section-list, .title-list').forEach(el => el.remove());
  document.querySelectorAll('.exercise-item.selected').forEach(el => el.classList.remove('selected'));
}

function loadLanguages() {
  const languageList = document.getElementById('languageList');
  languageList.textContent = "";

  // Agrupa por idLanguage, pero muestra el language_name
  const languages = uniqueByKey(data, "idLanguage");
  languages.forEach(item => {
    const btn = document.createElement('button');
    btn.classList.add("exercise-item");
    btn.textContent = item.language_name || "Sin nombre";
    btn.addEventListener("click", function() {
      removeOpenMenus();
      btn.classList.add("selected");
      loadSections(item.idLanguage, btn);
    });
    languageList.appendChild(btn);
  });
}

function loadSections(idLanguage, parentBtn) {
  const sectionList = document.createElement('div');
  sectionList.className = "section-list";

  // Filtrar por idLanguage
  const filtered = data.filter(item => item.idLanguage == idLanguage);
  const sections = uniqueByKey(filtered, "section");
  sections.forEach(item => {
    const btn = document.createElement('button');
    btn.classList.add("exercise-item");
    btn.textContent = item.section;
    btn.addEventListener("click", function(e) {
      e.stopPropagation();
      sectionList.querySelectorAll('.title-list').forEach(el => el.remove());
      sectionList.querySelectorAll('.exercise-item.selected').forEach(el => el.classList.remove('selected'));
      btn.classList.add("selected");
      loadTitles(idLanguage, item.section, btn);
    });
    sectionList.appendChild(btn);
  });

  parentBtn.insertAdjacentElement('afterend', sectionList);
}

function loadTitles(idLanguage, section, parentBtn) {
  const titleList = document.createElement('div');
  titleList.className = "title-list";

  // Filtrar por idLanguage y section
  const filtered = data.filter(item => item.idLanguage == idLanguage && item.section === section);
  filtered.sort((a, b) => a.order_num - b.order_num);

  filtered.forEach(item => {
    const btn = document.createElement('button');
    btn.classList.add("exercise-item");
    btn.textContent = item.title;
    btn.addEventListener("click", function(e) {
      e.stopPropagation();
      titleList.querySelectorAll('.exercise-item.selected').forEach(el => el.classList.remove('selected'));
      btn.classList.add("selected");
      showTheory(item);
    });
    titleList.appendChild(btn);
  });

  parentBtn.insertAdjacentElement('afterend', titleList);
}

function showTheory(item) {
  const container = document.getElementById('exerciseContainer');
  container.textContent = "";

  // Título
  const title = document.createElement("h2");
  title.textContent = item.title;
  container.appendChild(title);

  // Contenido teórico
  const content = document.createElement("div");
  content.className = "theory-content";
  content.textContent = item.content;
  container.appendChild(content);

  // Código de ejemplo (si existe)
  if (item.code_example && item.code_example.trim() !== "") {
    const codeBlock = document.createElement("pre");
    codeBlock.className = "theory-code";
    const code = document.createElement("code");
    code.textContent = item.code_example;
    codeBlock.appendChild(code);
    container.appendChild(codeBlock);
  }
}

async function initialize() {
  await fetchTheory();
  loadLanguages();
}

initialize();
