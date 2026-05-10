/**
 * Portföy Etkileşim Betiği
 * 
 * Bu betik portföydeki tüm etkileşimli özellikleri yönetir:
 * - Dil değiştirme (İngilizce/Türkçe)
 * - Tema değiştirme (Koyu/Açık mod)
 * - Mobil menü işlevselliği
 * - İmleç parıltı efekti
 * - Araç ipuçları (tooltip) güncelleme
 * - Form öğesi yer tutucu metni
 * 
 * Veri kalıcılığı localStorage aracılığıyla yönetilir:
 * - Kullanıcının dil tercihi
 * - Kullanıcının tema tercihi
 * 
 * @author Ayşe Nur Kendirci
 */

// ============================================================
// DOM ÖĞESİ REFERANSLARI
// HTML belgesinden JavaScript aracılığıyla erişilen temel öğeler
// ============================================================

const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

// ============================================================
// İMSEÇ PARILTI EFEKTİ
// Görsel iyileştirme: İmleç hareketini takip eden parıltı efekti
// ============================================================

document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;

    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

// ============================================================
// MOBİL MENÜ İŞLEVSELLİĞİ
// Mobil cihazlarda navigasyon menüsünü aç/kapa
// ============================================================

if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        // Aktif durumunu aç/kapa
        navigationLinks.classList.toggle("active");

        // Erişilebilirlik için ARIA özelliğini güncelle
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

// ============================================================
// DİL DEĞİŞTİRME FONKSİYONU
// Sayfadaki tüm çok dilli öğelere seçilen dili uygula
// ============================================================

/**
 * Seçilen dili sayfadaki tüm çok dilli öğelere uygula
 * Metin içeriğini, yer tutucu metinleri, araç ipuçlarını ve dil göstergesini günceller
 * Kullanıcı tercihini localStorage'da kalıcı hale getirir
 * 
 * @param {string} selectedLanguage - Dil kodu: 'en' veya 'tr'
 */
function applyLanguage(selectedLanguage) {
    // Belge dil özelliğini güncelle
    document.documentElement.lang = selectedLanguage;

    // data-en ve data-tr özelliklerine sahip tüm metin öğelerini güncelle
    const textElements = document.querySelectorAll("[data-en][data-tr]");
    textElements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    // Form yer tutucu metinlerini güncelle
    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );
    placeholderElements.forEach((el) => {
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

    // Araç ipucu içeriğini güncelle
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

    // Dil değiştirme düğmesi etiketini güncelle
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    // Dil tercihini kaydet
    localStorage.setItem("portfolio-language", selectedLanguage);
}

// ============================================================
// TEMA DEĞİŞTİRME FONKSİYONU
// Koyu ve açık tema arasında geçiş yap
// ============================================================

/**
 * Temayı sayfaya uygula
 * Sayfa arka planı ve metin renklerini günceller
 * Kullanıcı tercihini localStorage'da kalıcı hale getirir
 * 
 * @param {string} selectedTheme - Tema adı: 'dark-theme' veya 'light-theme'
 */
function applyTheme(selectedTheme) {
    // Önceki tema sınıflarını kaldır
    pageBody.classList.remove("dark-theme", "light-theme");
    
    // Yeni tema sınıfını uygula
    pageBody.classList.add(selectedTheme);

    // Tema değiştirme düğmesi etiketini güncelle
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    // Tema tercihini kaydet
    localStorage.setItem("portfolio-theme", selectedTheme);
}

// ============================================================
// OLAY DİNLEYİCİLERİ
// Kullanıcı etkileşimlerini işleyen fonksiyonlar
// ============================================================

/**
 * Dil değiştirme düğmesi tıklama işleyicisi
 * İngilizce ve Türkçe arasında geçiş yapar
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
 * Tema değiştirme düğmesi tıklama işleyicisi
 * Koyu ve açık tema arasında geçiş yapar
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
// BAŞLATMA
// Kaydedilen tercihleri yükler ve sayfa yüklenirken uygular
// ============================================================

/**
 * DOMContentLoaded olay işleyicisi
 * Kaydedilen dil ve tema tercihlerini uygular
 * Mobil menü erişilebilirlik özelliklerini başlatır
 */
document.addEventListener("DOMContentLoaded", () => {
    // Kaydedilen dil tercihini yükle (varsayılan: İngilizce)
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    // Kaydedilen tema tercihini yükle (varsayılan: Koyu tema)
    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    // Kaydedilen tercihleri uygula
    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    // Mobil menü için başlangıç ARIA özelliğini ayarla
    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});