/**
 * Portfolio Interaction Script
 * 
 * This script handles all interactive features on the portfolio:
 * - Language switching (English/Turkish)
 * - Theme toggling (Dark/Light mode)
 * - Mobile menu functionality
 * - Cursor glow effect
 * - Tooltip updates
 * - Form element placeholders
 * 
 * Data persistence is handled through localStorage for:
 * - User's language preference
 * - User's theme preference
 * 
 * @author Ayşe Nur Kendirci
 */

// ============================================================
// DOM ELEMENT REFERENCES
// ============================================================

const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

// ============================================================
// CURSOR GLOW EFFECT
// Visual enhancement: Adds a glow that follows mouse movement
// ============================================================

document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;

    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

// ============================================================
// MOBILE MENU FUNCTIONALITY
// Toggle navigation menu on mobile devices
// ============================================================

if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        // Toggle active state
        navigationLinks.classList.toggle("active");

        // Update ARIA attribute for accessibility
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

// ============================================================
// LANGUAGE SWITCHING FUNCTION
// Applies the selected language to all bilingual elements
// ============================================================

/**
 * Apply language to all bilingual elements on the page
 * Updates text content, placeholders, tooltips, and language indicator
 * Persists user preference in localStorage
 * 
 * @param {string} selectedLanguage - Language code: 'en' or 'tr'
 */
function applyLanguage(selectedLanguage) {
    // Update document language attribute
    document.documentElement.lang = selectedLanguage;

    // Update all text elements with data-en and data-tr attributes
    const textElements = document.querySelectorAll("[data-en][data-tr]");
    textElements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    // Update form placeholder text
    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );
    placeholderElements.forEach((el) => {
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

    // Update tooltip content
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

    // Persist language preference
    localStorage.setItem("portfolio-language", selectedLanguage);
}

// ============================================================
// THEME SWITCHING FUNCTION
// Toggles between dark and light theme
// ============================================================

/**
 * Apply theme to the page
 * Updates page background and text colors
 * Persists user preference in localStorage
 * 
 * @param {string} selectedTheme - Theme name: 'dark-theme' or 'light-theme'
 */
function applyTheme(selectedTheme) {
    // Remove previous theme classes
    pageBody.classList.remove("dark-theme", "light-theme");
    
    // Apply new theme class
    pageBody.classList.add(selectedTheme);

    // Update theme toggle button label
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    // Persist theme preference
    localStorage.setItem("portfolio-theme", selectedTheme);
}

// ============================================================
// EVENT LISTENERS
// ============================================================

/**
 * Language toggle button click handler
 * Switches between English and Turkish
 */
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const currentLanguage =
            localStorage.getItem("portfolio-language") || "en";

        const nextLanguage = currentLanguage === "en" ? "tr" : "en";

        applyLanguage(nextLanguage);
    });
}

/**
 * Theme toggle button click handler
 * Switches between dark and light theme
 */
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const currentTheme =
            localStorage.getItem("portfolio-theme") || "dark-theme";

        const nextTheme =
            currentTheme === "dark-theme" ? "light-theme" : "dark-theme";

        applyTheme(nextTheme);
    });
}

// ============================================================
// INITIALIZATION
// Loads saved preferences and applies them on page load
// ============================================================

/**
 * DOMContentLoaded event handler
 * Applies saved language and theme preferences
 * Initializes mobile menu accessibility attributes
 */
document.addEventListener("DOMContentLoaded", () => {
    // Load saved language preference (default: English)
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    // Load saved theme preference (default: Dark theme)
    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    // Apply persisted preferences
    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    // Set initial ARIA attribute for mobile menu
    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});