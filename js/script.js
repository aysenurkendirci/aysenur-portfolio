const cursorGlow = document.getElementById("cursorGlow");
const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");
const themeToggle = document.getElementById("themeToggle");
const langToggle = document.getElementById("langToggle");
const body = document.body;

document.addEventListener("mousemove", (event) => {
    if (cursorGlow) {
        cursorGlow.style.left = `${event.clientX}px`;
        cursorGlow.style.top = `${event.clientY}px`;
    }
});

if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
}

function applyLanguage(lang) {
    document.documentElement.lang = lang;

    const translatableElements = document.querySelectorAll("[data-en][data-tr]");
    translatableElements.forEach((element) => {
        element.textContent = element.dataset[lang];
    });

    const tooltipElements = document.querySelectorAll("[data-tooltip-en][data-tooltip-tr]");
    tooltipElements.forEach((element) => {
        const tooltipText = lang === "en" ? element.dataset.tooltipEn : element.dataset.tooltipTr;
        element.setAttribute("data-tooltip", tooltipText);
    });

    if (langToggle) {
        langToggle.textContent = lang === "en" ? "TR" : "EN";
    }

    localStorage.setItem("portfolio-language", lang);
}

function applyTheme(theme) {
    body.classList.remove("dark-theme", "light-theme");
    body.classList.add(theme);

    if (themeToggle) {
        themeToggle.textContent = theme === "dark-theme" ? "☀" : "☾";
    }

    localStorage.setItem("portfolio-theme", theme);
}

if (langToggle) {
    langToggle.addEventListener("click", () => {
        const currentLang = localStorage.getItem("portfolio-language") || "en";
        const newLang = currentLang === "en" ? "tr" : "en";
        applyLanguage(newLang);
    });
}

if (themeToggle) {
    themeToggle.addEventListener("click", () => {
        const currentTheme = localStorage.getItem("portfolio-theme") || "dark-theme";
        const newTheme = currentTheme === "dark-theme" ? "light-theme" : "dark-theme";
        applyTheme(newTheme);
    });
}

const savedLanguage = localStorage.getItem("portfolio-language") || "en";
const savedTheme = localStorage.getItem("portfolio-theme") || "dark-theme";

applyLanguage(savedLanguage);
applyTheme(savedTheme);