document.addEventListener("DOMContentLoaded", () => {
  const themeToggle = document.getElementById("theme-toggle");
  const themeIcon = document.getElementById("theme-icon");

  // Aplicar el estado guardado en localStorage
  const isDarkMode = localStorage.getItem("dark-mode") === "true";
  if (isDarkMode) {
    document.body.classList.add("dark-mode");
    themeIcon.className = "bi bi-sun";
  } else {
    themeIcon.className = "bi bi-moon";
  }

  // Alternar el modo día/noche y guardar el estado
  themeToggle.addEventListener("click", () => {
    const isDarkMode = document.body.classList.toggle("dark-mode");
    themeIcon.className = isDarkMode ? "bi bi-sun" : "bi bi-moon";
    localStorage.setItem("dark-mode", isDarkMode);
  });

  // Asegurar que el estado se aplique al cambiar de página
  window.addEventListener("storage", () => {
    const isDarkMode = localStorage.getItem("dark-mode") === "true";
    if (isDarkMode) {
      document.body.classList.add("dark-mode");
      themeIcon.className = "bi bi-sun";
    } else {
      document.body.classList.remove("dark-mode");
      themeIcon.className = "bi bi-moon";
    }
  });
});