/* ==================================================
   HTML ELEMANLARINI SEÇME
   JavaScript ile kontrol edeceğimiz HTML elemanlarını burada seçiyoruz.
   getElementById kullanmamızın sebebi, id değerlerinin sayfada tekil olmasıdır.
   ================================================== */
const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

/* ==================================================
   CURSOR GLOW EFEKTİ
   Mouse hareket ettikçe ışık efektinin konumu güncellenir.
   cursorGlow elementi varsa çalışır; yoksa hata vermez.
   ================================================== */
document.addEventListener("mousemove", (event) => {
    if (cursorGlowElement) {
        cursorGlowElement.style.left = `${event.clientX}px`;
        cursorGlowElement.style.top = `${event.clientY}px`;
    }
});

/* ==================================================
   MOBİL MENÜ AÇ / KAPAT
   Hamburger butona tıklanınca nav-links class listesine active eklenir veya kaldırılır.
   CSS tarafında .nav-links.active görünür hale gelir.
   ================================================== */
if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        navigationLinks.classList.toggle("active");
    });
}

/* ==================================================
   DİL DEĞİŞTİRME FONKSİYONU
   Sayfadaki data-en ve data-tr attribute'larına sahip metinleri değiştirir.
   Örneğin:
   <h1 data-en="Hello" data-tr="Merhaba">Hello</h1>
   ================================================== */
function applyLanguage(selectedLanguage) {
    /* HTML etiketinin lang değerini günceller */
    document.documentElement.lang = selectedLanguage;

    /* data-en ve data-tr içeren tüm elemanları seçer */
    const translatableElements = document.querySelectorAll("[data-en][data-tr]");

    /* Her elemanın metnini seçilen dile göre değiştirir */
    translatableElements.forEach((element) => {
        element.textContent = element.dataset[selectedLanguage];
    });

    /* Tooltip metinleri için ayrı data attribute kullanan elemanları seçer */
    const tooltipElements = document.querySelectorAll("[data-tooltip-en][data-tooltip-tr]");

    /* Tooltip açıklamalarını seçilen dile göre günceller */
    tooltipElements.forEach((element) => {
        const tooltipText =
            selectedLanguage === "en"
                ? element.dataset.tooltipEn
                : element.dataset.tooltipTr;

        element.setAttribute("data-tooltip", tooltipText);
    });

    /* Dil butonunun üzerinde görünen yazıyı günceller */
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");

        if (label) {
            /*
               Kullanıcı mevcut dil İngilizce iken butonda TR görür.
               Çünkü butona basınca Türkçeye geçecektir.
            */
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    /* Seçilen dili tarayıcı hafızasına kaydeder */
    localStorage.setItem("portfolio-language", selectedLanguage);
}

/* ==================================================
   TEMA DEĞİŞTİRME FONKSİYONU
   body üzerine dark-theme veya light-theme class'ı ekler.
   CSS değişkenleri bu class'a göre değiştiği için tema değişir.
   ================================================== */
function applyTheme(selectedTheme) {
    /* Önce mevcut tema class'larını temizler */
    pageBody.classList.remove("dark-theme", "light-theme");

    /* Sonra seçilen temayı body etiketine ekler */
    pageBody.classList.add(selectedTheme);

    /* Tema butonu üzerindeki ikon yazısını günceller */
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");

        if (label) {
            /*
               Koyu temadayken güneş ikonu gösterilir.
               Çünkü kullanıcı basarsa açık temaya geçecektir.
            */
            label.textContent = selectedTheme === "dark-theme" ? "☀" : "☾";
        }
    }

    /* Seçilen temayı tarayıcı hafızasına kaydeder */
    localStorage.setItem("portfolio-theme", selectedTheme);
}

/* ==================================================
   DİL BUTONUNA TIKLAMA OLAYI
   Kullanıcı butona basınca en ↔ tr arasında geçiş yapılır.
   ================================================== */
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const currentLanguage = localStorage.getItem("portfolio-language") || "en";
        const newLanguage = currentLanguage === "en" ? "tr" : "en";

        applyLanguage(newLanguage);
    });
}

/* ==================================================
   TEMA BUTONUNA TIKLAMA OLAYI
   Kullanıcı butona basınca dark-theme ↔ light-theme arasında geçiş yapılır.
   ================================================== */
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const currentTheme = localStorage.getItem("portfolio-theme") || "dark-theme";
        const newTheme = currentTheme === "dark-theme" ? "light-theme" : "dark-theme";

        applyTheme(newTheme);
    });
}

/* ==================================================
   KAYITLI DİL VE TEMA BİLGİSİNİ YÜKLEME
   Kullanıcının önceki seçimi localStorage içinde tutulur.
   Sayfa yenilense bile aynı dil ve tema korunur.
   ================================================== */
const savedLanguage = localStorage.getItem("portfolio-language") || "en";
const savedTheme = localStorage.getItem("portfolio-theme") || "dark-theme";

applyLanguage(savedLanguage);
applyTheme(savedTheme);
