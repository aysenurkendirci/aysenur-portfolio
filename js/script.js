/**
 * PORTFÖY ETKILEŞIM BETIĞI (script.js)
 * ============================================================
 * 
 * Bu dosya, portföy web sitesinin tüm client-side etkileşimlerini yönetir.
 * 
 * İşlevler:
 * 1. Dil Değiştirme: İngilizce ↔ Türkçe
 * 2. Tema Yönetimi: Koyu ↔ Açık mod
 * 3. Mobil Menü: Responsive navigasyon açıp kapatma
 * 4. Görsel Efektler: İmleç parıltı animasyonu
 * 5. Dinamik İçerik: Tooltip ve placeholder güncellemeleri
 * 
 * Veri Kalıcılığı:
 * - localStorage: Kullanıcı tercihlerini kaydeder
 *   * portfolio-language: Seçilen dil (en/tr)
 *   * portfolio-theme: Seçilen tema (dark-theme/light-theme)
 * 
 * Tarayıcı Desteği:
 * - localStorage: Chrome 4+, Firefox 3.5+, Safari 4+, IE 8+
 * - classList: Chrome 22+, Firefox 3.6+, Safari 5.1+, IE 10+
 * - querySelector: Tüm modern tarayıcılar
 * 
 * Performans Notları:
 * - Event delegation kullanarak çok sayıda dinleyici eklenmez
 * - querySelector yerine getElementById kullanıldığında daha hızlı
 * - Değişkenleri başında cache edilerek DOM sorgusu tekrarlanmaz
 * 
 * Erişilebilirlik (WCAG 2.1):
 * - aria-expanded: Menü durumu ekran okuyuculara bildirilir
 * - Keyboard: Tab ve Enter ile tüm işlevler erişilebilir
 * - Focus management: Tüm butonlar focus edilebilir
 * 
 * @author Ayşe Nur Kendirci
 * @version 1.0
 * @requires No external dependencies
 */


const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

// ============================================================
// İMSEÇ PARILTI EFEKTİ (CURSOR GLOW)
// ============================================================
// 
// Teknik İmplementasyon:
// - mousemove: Her fare hareketi yapıldığında tetiklenir
// - clientX/clientY: Viewport (görünen pencere) koordinatları
// - transform: translate(-50%, -50%) ile efektin merkezi mouse'a
// - 0.05s linear: Smooth ancak responsive hareket
// 
// Performans Optimizasyonu:
// - Koşul (if) ile sadece eğer element var ise işlem yapılır
// - transform3d yerine transform kullanılır (daha hızlı)
// - requestAnimationFrame yerine basit event (basit efekt için yeterli)
// 
// Tarayıcı Desteği:
// - transform: Tüm modern tarayıcılar destekler
// - clientX/clientY: IE 9+ ve üzeri
// ============================================================

document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;

    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

// ============================================================
// MOBİL MENÜ İŞLEVSELLİĞİ (RESPONSIVE NAVIGATION)
// ============================================================
// 
// Responsive Davranış (Mobile-First):
// - Desktop: Menü daima görünür (display: flex)
// - Tablet (768px altı): Hamburger ikonu görünür
// - Mobile (480px altı): Tam ekran mobil menü
// 
// Toggle Mekanizması:
// - classList.toggle("active"): Class'ı ekle/çıkar
// - CSS'de: .nav-links.active { display: flex; }
// - aria-expanded: ARIA özelliğini güncelle (erişilebilirlik)
// 
// ARIA Erişilebilirlik:
// - aria-expanded="true": Menü açık (ekran okuyuculara bildir)
// - aria-expanded="false": Menü kapalı
// - aria-controls: Hangi öğeyi kontrol ettiğini belirtir (navLinks)
// 
// Event Delegation Notu:
// - Sadece hamburger butonuna listener ekler
// - Menü öğelerindeki click event'leri body'ye bubble up olur
//   (opsiyonel: menü öğelerine click'te menüyü kapatabilir)
// ============================================================

if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        // Toggle mekanizması: varsa sil, yoksa ekle
        navigationLinks.classList.toggle("active");

        // Erişilebilirlik: ARIA özelliğini güncelle
        // Ekran okuyucular bu durumu duyurur
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

// ============================================================
// DİL DEĞİŞTİRME İŞLEVSELLİĞİ (LANGUAGE SWITCHING)
// ============================================================
// 
// Çok Dilli Tasarım Mimarisi:
// 1. HTML'de data-en ve data-tr öğeler kaydedilir
// 2. JavaScript bu öznitelikleri okur ve gösterir
// 3. HTML değiştirmeden sadece öznitelik değiştirilir
// 
// Teknik İmplementasyon:
// 
// HTML örneği:
// <p data-en="Hello" data-tr="Merhaba">Hello</p>
// 
// JavaScript:
// element.dataset.en  → "Hello"
// element.dataset.tr  → "Merhaba"
// element.textContent = element.dataset[selectedLanguage]
// 
// Queryselector Performansı:
// - querySelectorAll: Tüm matching öğeleri döner (NodeList)
// - NodeList.forEach: tüm öğeler üzerinde döngü
// - Kompleks seçiciler (attribute selectors) biraz yavaş olabilir
//   ama bu veri seti için kabul edilebilir
// 
// localStorage Kullanımı:
// - setItem("key", "value"): Verileri kaydet
// - getItem("key"): Kayıtlı veriyi oku
// - localStorage 5-10MB veri saklayabilir
// - Tarayıcı kapatılsa da veri kalır
// 
// document.documentElement.lang:
// - HTML lang özelliğini ayarlar
// - Ekran okuyucuların doğru dili okuması için önemli
// - HTML: <html lang="en"> veya <html lang="tr">
// ============================================================

/**
 * Seçilen dili sayfadaki tüm çok dilli öğelere uygula
 * 
 * İşlev Akışı:
 * 1. HTML lang özelliğini güncelle (erişilebilirlik)
 * 2. Tüm [data-en][data-tr] öğeleri bul ve metin güncelle
 * 3. Form placeholder'larını güncelle
 * 4. Tooltip'leri güncelle
 * 5. Dil düğmesinin etiketini güncelle (EN/TR)
 * 6. Tercihini localStorage'a kaydet
 * 
 * @param {string} selectedLanguage - Dil kodu: 'en' veya 'tr'
 * 
 * @example
 * applyLanguage('tr'); // Sayfayı Türkçeye çevir
 * applyLanguage('en'); // Sayfayı İngilizceye çevir
 */
function applyLanguage(selectedLanguage) {
    // Belge dil özelliğini güncelle
    // Örn: <html lang="en"> → <html lang="tr">
    document.documentElement.lang = selectedLanguage;

    // Metin öğelerini güncelle: data-en ve data-tr
    // Örn: <p data-en="Hello" data-tr="Merhaba">
    const textElements = document.querySelectorAll("[data-en][data-tr]");
    textElements.forEach((el) => {
        // dataset: HTML data-* özniteliklerine erişim sağlar
        // element.dataset['en'] = element.getAttribute('data-en')
        el.textContent = el.dataset[selectedLanguage];
    });

    // Form yer tutucu (placeholder) metinlerini güncelle
    // Örn: <input data-placeholder-en="Name" data-placeholder-tr="Ad">
    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );
    placeholderElements.forEach((el) => {
        // Seçilen dile göre uygun placeholder yükle
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

    // Tooltip (araç ipucu) içeriğini güncelle
    // Örn: <span data-tooltip-en="..." data-tooltip-tr="...">
    const tooltipElements = document.querySelectorAll(
        "[data-tooltip-en][data-tooltip-tr]"
    );
    tooltipElements.forEach((el) => {
        // CSS'de ::after { content: attr(data-tooltip); } ile gösterilir
        const tooltipText =
            selectedLanguage === "en"
                ? el.dataset.tooltipEn
                : el.dataset.tooltipTr;
        el.setAttribute("data-tooltip", tooltipText);
    });

    // Dil değiştirme düğmesinin etiketini güncelle
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");
        if (label) {
            // İngilizce'ye gitmişse "TR" göster, Türkçeye gitmişse "EN" göster
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    // Dil tercihini kalıcı hale getir
    localStorage.setItem("portfolio-language", selectedLanguage);
}

/**
 * Tema ayarını sayfaya uygula
 * 
 * İşlev Akışı:
 * 1. Önceki tema sınıflarını kaldır
 * 2. Yeni tema sınıfını ekle (CSS variables otomatik değişir)
 * 3. Tema düğmesinin ikonunu güncelle (☾ veya ☀)
 * 4. Tercihini localStorage'a kaydet
 * 
 * Tema Seçenekleri:
 * - 'dark-theme': Koyu mod (varsayılan)
 * - 'light-theme': Açık mod
 * 
 * @param {string} selectedTheme - Tema adı: 'dark-theme' veya 'light-theme'
 * 
 * @example
 * applyTheme('dark-theme');  // Koyu temaya geç
 * applyTheme('light-theme'); // Açık temaya geç
 */
function applyTheme(selectedTheme) {
    // Önceki tema sınıflarını kaldır
    // classList.remove multiple değerler destekler (ES2019+)
    pageBody.classList.remove("dark-theme", "light-theme");
    
    // Yeni tema sınıfını ekle
    // Bu sınıf CSS'de :root değişkenlerini override eder
    pageBody.classList.add(selectedTheme);

    // Tema düğmesinin ikonunu güncelle
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            // Koyu temada "☾" (ay), açık temada "☀" (güneş)
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    // Tema tercihini kalıcı hale getir
    localStorage.setItem("portfolio-theme", selectedTheme);
}

/**
 * Dil Değiştirme Düğmesi - Tıklama Olayı
 * 
 * Davranış:
 * - Mevcut dili localStorage'dan oku
 * - Diğer dile geç (en → tr, tr → en)
 * - applyLanguage() ile değişiklikleri uygula
 * 
 * Flow:
 * 1. Düğmeye tıkla
 * 2. Şu anki dili oku (varsayılan: 'en')
 * 3. Ters dile geç (ternary operator)
 * 4. applyLanguage() fonksiyonunu çağır
 */
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        // Kaydedilmiş dili oku, yoksa İngilizce kullan
        const currentLanguage =
            localStorage.getItem("portfolio-language") || "en";

        // İngilizce ise Türkçeye, Türkçe ise İngilizceye geç
        const nextLanguage = currentLanguage === "en" ? "tr" : "en";

        // Dili uygula
        applyLanguage(nextLanguage);
    });
}

/**
 * Tema Değiştirme Düğmesi - Tıklama Olayı
 * 
 * Davranış:
 * - Mevcut temayı localStorage'dan oku
 * - Diğer temaya geç (dark → light, light → dark)
 * - applyTheme() ile değişiklikleri uygula
 * 
 * Flow:
 * 1. Düğmeye tıkla
 * 2. Şu anki temayı oku (varsayılan: 'dark-theme')
 * 3. Ters temaya geç (ternary operator)
 * 4. applyTheme() fonksiyonunu çağır
 */
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        // Kaydedilmiş temayı oku, yoksa Koyu temayı kullan
        const currentTheme =
            localStorage.getItem("portfolio-theme") || "dark-theme";

        // Koyu ise Açık'a, Açık ise Koyu'ya geç
        const nextTheme =
            currentTheme === "dark-theme" ? "light-theme" : "dark-theme";

        // Temayı uygula
        applyTheme(nextTheme);
    });
}

/**
 * DOM Tamamen Yüklendikten Sonra Çalıştırılan Kod
 * 
 * Görevler:
 * 1. Kullanıcının kaydedilmiş tercihlerini yükle
 * 2. Sayfa arayüzünü kullanıcı tercihlerine göre ayarla
 * 3. Erişilebilirlik özelliklerini başlat
 * 
 * Çok Sayıda DOMContentLoaded:
 * - addEventListener ile tanımlanan tüm dinleyiciler tetiklenir
 * - Sıra: HTML'de tanımlanan sıra
 * - Bu bölüm en sonda çalışacak
 */
document.addEventListener("DOMContentLoaded", () => {
    // Kaydedilmiş dil tercihini yükle
    // localStorage.getItem("key") yoksa null döner, || ile varsayılan belirleriz
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "en";

    // Kaydedilmiş tema tercihini yükle
    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    // Kaydedilmiş tercihleri sayfaya uygula
    // Bu fonksiyonlar CSS'i ve HTML'i güncelleyecek
    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    // Mobil menü için başlangıç ARIA özelliğini ayarla
    // Erişilebilirlik: Ekran okuyucuya menü durumunu söyle
    if (menuToggleButton && navigationLinks) {
        // Menü başlangıçta kapalı mı açık mı? class kontrolüyle belirle
        const isMenuOpen = navigationLinks.classList.contains("active");
        
        // aria-expanded: Düğmeyi kontrol eden öğenin durumunu gösterir
        // "true" = menü açık, "false" = menü kapalı
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }
});