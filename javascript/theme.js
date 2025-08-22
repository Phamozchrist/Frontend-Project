document.addEventListener("DOMContentLoaded", function () {
  const themeSelect = document.getElementById("theme");
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

  function applyTheme(theme) {
    document.body.classList.remove("light-theme", "dark-theme", "system-default-theme");

    if (theme === "system-default-theme") {
      document.body.classList.add(prefersDark.matches ? "dark-theme" : "light-theme");
    } else {
      document.body.classList.add(theme);
    }
  }

  // Load saved theme
  const savedTheme = localStorage.getItem("theme") || "system-default-theme";
  themeSelect.value = savedTheme;
  applyTheme(savedTheme);

  // Change handler
  themeSelect.addEventListener("change", function () {
    const selectedTheme = this.value;
    localStorage.setItem("theme", selectedTheme);
    applyTheme(selectedTheme);
  });

  // Watch OS theme changes
  prefersDark.addEventListener("change", function () {
    if (themeSelect.value === "system-default-theme") {
      applyTheme("system-default-theme");
    }
  });
});
