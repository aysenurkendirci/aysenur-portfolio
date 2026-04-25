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
        const label = langToggle.querySelector(".tool-label");
        if (label) {
            label.textContent = lang === "en" ? "TR" : "EN";
        }
    }

    localStorage.setItem("portfolio-language", lang);
}

function applyTheme(theme) {
    body.classList.remove("dark-theme", "light-theme");
    body.classList.add(theme);

    if (themeToggle) {
        const label = themeToggle.querySelector(".tool-label");
        if (label) {
            label.textContent = theme === "dark-theme" ? "☀" : "☾";
        }
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
// ===============================
// INTERACTIVE ID CARD
// ===============================

const lanyardCard = document.getElementById("lanyardCard");
const idCard = document.querySelector(".id-card");

if (lanyardCard && idCard) {
    lanyardCard.addEventListener("mousemove", (event) => {
        const rect = lanyardCard.getBoundingClientRect();

        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        const rotateY = ((x / rect.width) - 0.5) * 20;
        const rotateX = ((y / rect.height) - 0.5) * -20;

        idCard.style.transform =
            `rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotate(-3deg)`;
    });

    lanyardCard.addEventListener("mouseleave", () => {
        idCard.style.transform = "rotate(-5deg)";
    });
}