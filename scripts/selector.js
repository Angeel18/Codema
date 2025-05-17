const languageSelect = document.getElementById('languageSelect');
const typeSelect = document.getElementById('typeSelect');
const goBtn = document.getElementById('goBtn');

// Load languages when the page loads
window.addEventListener('DOMContentLoaded', async () => {
  try {
    const res = await fetch('selectorExercise.php');
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

// When a language is selected, load exercise types
languageSelect.addEventListener('change', async () => {
  const idLanguage = languageSelect.value;

  // Remove all existing options except the first one
  while (typeSelect.options.length > 1) {
    typeSelect.remove(1);
  }

  typeSelect.disabled = true;

  if (!idLanguage) return;

  try {
    const res = await fetch('selectorExercise.php', {
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

// Handle redirection when clicking the button
goBtn.addEventListener('click', () => {
  const selectedLanguageOption = languageSelect.options[languageSelect.selectedIndex];
  const selectedType = typeSelect.value;

  if (!selectedLanguageOption.value || !selectedType) {
    alert("Please select both fields.");
    return;
  }

  const folder = selectedLanguageOption.textContent.replace(/\s+/g, '');
  const file = selectedType;

  window.location.href = `./${folder}/${file}?Language=${folder}&Type=${selectedType}`;
});
