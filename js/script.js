/*
==================================================
SCRIPT FILE
Bu dosya:
- Tema değiştirme
- Dil değiştirme
- Mobil menü kontrolü
- Mouse glow efekti
işlemlerini yönetir.
==================================================
*/

/* ==================================================
   DOM ELEMENT SEÇİMLERİ
================================================== */
const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

/* ==================================================
   CURSOR GLOW EFEKTİ
================================================== */
document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;

    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

/* ==================================================
   MOBİL MENÜ KONTROLÜ (ARIA FIX EKLENDİ)
================================================== */
if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        navigationLinks.classList.toggle("active");

        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

/* ==================================================
   DİL DEĞİŞTİRME FONKSİYONU
================================================== */
function applyLanguage(selectedLanguage) {
    document.documentElement.lang = selectedLanguage;

    const elements = document.querySelectorAll("[data-en][data-tr]");

    elements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    /* Tooltip desteği */
    const tooltipElements = document.querySelectorAll(
        "[data-tooltip-en][data-tooltip-tr]"
    );

    tooltipElements.forEach((el) => {
        const text =
            selectedLanguage === "en"
                ? el.dataset.tooltipEn
                : el.dataset.tooltipTr;

        el.setAttribute("data-tooltip", text);
    });

    /* Buton label */
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    localStorage.setItem("portfolio-language", selectedLanguage);
}

/* ==================================================
   TEMA DEĞİŞTİRME
================================================== */
function applyTheme(selectedTheme) {
    pageBody.classList.remove("dark-theme", "light-theme");
    pageBody.classList.add(selectedTheme);

    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent =
                selectedTheme === "dark-theme" ? "☀" : "☾";
        }
    }

    localStorage.setItem("portfolio-theme", selectedTheme);
}

/* ==================================================
   EVENT LISTENERS
================================================== */

/* Dil toggle */
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const current =
            localStorage.getItem("portfolio-language") || "en";

        const next = current === "en" ? "tr" : "en";
        applyLanguage(next);
    });
}

/* Tema toggle */
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const current =
            localStorage.getItem("portfolio-theme") || "dark-theme";

        const next =
            current === "dark-theme" ? "light-theme" : "dark-theme";

        applyTheme(next);
    });
}

/* ==================================================
   INITIAL LOAD
================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    /* Sayfa açıldığında ARIA doğru olsun */
    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});