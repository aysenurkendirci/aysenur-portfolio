// Portfolio Site - Client-side interactions
// Manages: language toggle (EN/TR), theme toggle (dark/light), mobile menu, cursor effect


const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

// Cursor glow effect - follows mouse movement
document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;
    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

// Mobile menu toggle
if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        navigationLinks.classList.toggle("active");
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

// Language switching - apply selected language to all multilingual elements
function applyLanguage(selectedLanguage) {
    // Update HTML lang attribute for accessibility
    document.documentElement.lang = selectedLanguage;

    // Update text elements with data-en and data-tr attributes
    const textElements = document.querySelectorAll("[data-en][data-tr]");
    textElements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    // Update form placeholders
    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );
    placeholderElements.forEach((el) => {
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

    // Update tooltips
    const tooltipElements = document.querySelectorAll(
        "[data-tooltip-en][data-tooltip-tr]"
    );
    tooltipElements.forEach((el) => {
        const tooltipText =
            selectedLanguage === "en"
                ? el.dataset.tooltipEn
                : el.dataset.tooltipTr;
        el.setAttribute("data-tooltip", tooltipText);
    });

    // Update language toggle button label
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    // Save preference
    localStorage.setItem("portfolio-language", selectedLanguage);
}

// Theme switching - apply selected theme (dark-theme or light-theme)
function applyTheme(selectedTheme) {
    // Remove previous theme classes
    pageBody.classList.remove("dark-theme", "light-theme");
    
    // Add new theme class
    pageBody.classList.add(selectedTheme);

    // Update theme toggle button label (moon/sun icon)
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    // Save preference
    localStorage.setItem("portfolio-theme", selectedTheme);
}

// Language toggle button - click event
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const currentLanguage =
            localStorage.getItem("portfolio-language") || "en";
        const nextLanguage = currentLanguage === "en" ? "tr" : "en";
        applyLanguage(nextLanguage);
    });
}

// Theme toggle button - click event
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const currentTheme =
            localStorage.getItem("portfolio-theme") || "dark-theme";
        const nextTheme =
            currentTheme === "dark-theme" ? "light-theme" : "dark-theme";
        applyTheme(nextTheme);
    });
}

// Initialize on page load - restore user preferences
document.addEventListener("DOMContentLoaded", () => {
    // Load saved language preference
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    // Load saved theme preference
    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    // Apply saved preferences
    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    // Set initial menu state for accessibility
    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});