/*
==================================================
SCRIPT FILE
Tema, dil, mobil menü, tooltip, placeholder ve cursor glow efektini yönetir.
==================================================
*/

const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

/* Mouse glow efekti */
document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;

    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

/* Mobil menü açma-kapama */
if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        navigationLinks.classList.toggle("active");

        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

/* Dil değiştirme */
function applyLanguage(selectedLanguage) {
    document.documentElement.lang = selectedLanguage;

    const textElements = document.querySelectorAll("[data-en][data-tr]");

    textElements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );

    placeholderElements.forEach((el) => {
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

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

    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");

        if (label) {
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    localStorage.setItem("portfolio-language", selectedLanguage);
}

/* Tema değiştirme */
function applyTheme(selectedTheme) {
    pageBody.classList.remove("dark-theme", "light-theme");
    pageBody.classList.add(selectedTheme);

    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");

        if (label) {
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    localStorage.setItem("portfolio-theme", selectedTheme);
}

/* Dil butonu */
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const currentLanguage =
            localStorage.getItem("portfolio-language") || "en";

        const nextLanguage = currentLanguage === "en" ? "tr" : "en";

        applyLanguage(nextLanguage);
    });
}

/* Tema butonu */
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const currentTheme =
            localStorage.getItem("portfolio-theme") || "dark-theme";

        const nextTheme =
            currentTheme === "dark-theme" ? "light-theme" : "dark-theme";

        applyTheme(nextTheme);
    });
}

/* Sayfa ilk açıldığında kayıtlı dil ve tema uygulanır */
document.addEventListener("DOMContentLoaded", () => {
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});