document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("preferencesForm");
    const themeSelect = document.getElementById("theme");
    const fontSizeSelect = document.getElementById("fontSize");
    const languageSelect = document.getElementById("language");
    const lastVisitDisplay = document.getElementById("lastVisit");
    const resetButton = document.getElementById("resetButton");
  
    // Cargar preferencias al iniciar
    loadPreferences();
    displayLastVisit();
  
    // Guardar preferencias al enviar el formulario
    form.addEventListener("submit", (event) => {
      event.preventDefault();
  
      const preferences = {
        theme: themeSelect.value,
        fontSize: fontSizeSelect.value,
        language: languageSelect.value,
      };
  
      localStorage.setItem("preferences", JSON.stringify(preferences));
      applyPreferences(preferences);
    });
  
    // Restablecer preferencias
    resetButton.addEventListener("click", () => {
      localStorage.removeItem("preferences");
      location.reload();
    });
  
    // Función para cargar preferencias
    function loadPreferences() {
      const storedPreferences = JSON.parse(localStorage.getItem("preferences"));
  
      if (storedPreferences) {
        themeSelect.value = storedPreferences.theme;
        fontSizeSelect.value = storedPreferences.fontSize;
        languageSelect.value = storedPreferences.language;
  
        applyPreferences(storedPreferences);
      }
    }
  
    // Aplicar preferencias
    function applyPreferences(preferences) {
      document.body.className = `${preferences.theme} ${preferences.fontSize}`;
    }
  
    // Mostrar última visita
    function displayLastVisit() {
      const lastVisit = sessionStorage.getItem("lastVisit");
      if (lastVisit) {
        lastVisitDisplay.textContent = `Última visita: ${lastVisit}`;
      } else {
        lastVisitDisplay.textContent = "Es tu primera visita en esta sesión.";
      }
  
      const now = new Date().toLocaleString();
      sessionStorage.setItem("lastVisit", now);
    }
  });
  