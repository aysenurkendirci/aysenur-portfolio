// Runs synchronously as the first thing inside <body>, before any content is painted.
// Applies the saved theme and language immediately so the page never flashes
// the wrong theme or language. Only whitelisted values are accepted from storage.
(function () {
    var THEMES = ["dark-theme", "light-theme"];
    var LANGS = ["tr", "en"];

    function read(key) {
        try {
            return window.localStorage.getItem(key);
        } catch (e) {
            return null; // private mode / storage disabled
        }
    }

    var theme = read("portfolio-theme");
    if (THEMES.indexOf(theme) === -1) theme = "dark-theme"; // site default

    var lang = read("portfolio-language");
    if (LANGS.indexOf(lang) === -1) lang = "tr";

    var root = document.documentElement;
    root.classList.add("js");
    root.lang = lang;
    root.style.colorScheme = theme === "light-theme" ? "light" : "dark";

    if (document.body) {
        document.body.classList.remove("dark-theme", "light-theme");
        document.body.classList.add(theme);
    }

    window.__initialTheme = theme;
    window.__initialLanguage = lang;
})();
