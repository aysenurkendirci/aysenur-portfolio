
<header class="site-header" role="banner">
    <nav class="navbar" aria-label="Ana navigasyon">
        <div class="container navbar-container">
            <a href="index.php#home" class="brand" aria-label="Ana bölüme git">
                <span class="brand-line">
                    <span class="token-const">const</span>
                    <span class="token-var">developer</span>
                    <span class="token-eq">=</span>
                    <span class="token-string">"Ayşe Nur Kendirci"</span>
                    <span class="token-semi">;</span>
                    <span class="brand-cursor" aria-hidden="true"></span>
                </span>
            </a>

            <!-- 
                MOBİL MENÜ AÇ/KAPA DÜĞMESI
                
                Davranış:
                - Sadece 768px altında görünür (CSS @media)
                - Tıklanınca .nav-links.active class'ı toggle eder
                - JavaScript: classList.toggle("active")
                
                Erişilebilirlik:
                - type="button": Anlamsal doğruluk
                - aria-label: Ne yaptığını açıklar
                - aria-controls="navLinks": Hangi öğeyi kontrol eder
                - aria-expanded: Menü açık mı kapalı mı
                
                İçerik:
                - ☰: Hamburger ikonu (Unicode)
                - aria-hidden="true": İkonu ekran okuyucudan gizle
                  (aria-label zaten açıklamalı)
            -->
            <button
                class="menu-toggle"
                id="menuToggle"
                type="button"
                aria-label="Navigasyon menüsünü aç"
                aria-controls="navLinks"
                aria-expanded="false"
            >
                <span aria-hidden="true">☰</span>
            </button>

            <!-- 
                NAVIGASYON LINKLERI
                
                Semantic HTML:
                - <ul>: Unordered list (sırasız liste)
                - <li>: List item (her link bir list item)
                - Anlamsal olarak "linkler listesi" demektir
                
                Çok Dilli Veriler:
                - data-en="..." : İngilizce metin
                - data-tr="..." : Türkçe metin
                - İçerik: Varsayılan (İngilizce)
                - JavaScript dil değişince metin güncellenir
                
                Responsive Davranış:
                - Desktop: display: flex (görünür)
                - Mobil: display: none (gizli)
                - .active class: display: flex (göster)
                
                İç Linkler (#):
                - index.php#about → sayfa içinde about bölümüne atla
                - HTML Smooth Scroll: css/base.css scroll-behavior: smooth
            -->
            <ul class="nav-links" id="navLinks">
                <li><a href="#about" data-en="About" data-tr="Hakkımda">About</a></li>
                <li><a href="#skills" data-en="Tech Stack" data-tr="Teknolojiler">Tech Stack</a></li>
                <li><a href="#experience" data-en="Experience" data-tr="Deneyim">Experience</a></li>
                <li><a href="#projects" data-en="Projects" data-tr="Projeler">Projects</a></li>
                <li><a href="#contact" data-en="Contact" data-tr="İletişim">Contact</a></li>

                <!-- CV İndirme Linki -->
                <li>
                    <a
                        href="<?= e($profile["cv"]); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        data-en="CV"
                        data-tr="CV"
                    >
                        CV
                    </a>
                </li>
            </ul>

            <!-- 
                TEMA VE DİL AYARLARI
                
                Amacı:
                - Dil seçimi (EN/TR)
                - Tema seçimi (☾/☀)
                
                Tasarım:
                - toolbar-shell: İçeriği bir "bar" içine alır
                - tool-chip: Her düğme
                
                Erişilebilirlik:
                - aria-label: Düğmenin amacını açıklar
                - title: Hover'da tooltip (açıklama)
                - Focusable: Tab tuşu ile erişilebilir
                
                JavaScript Bağlantısı:
                - id="themeToggle": JS tarafından seçilir
                - id="langToggle": JS tarafından seçilir
                - addEventListener("click", ...): Tıklamaya tepki
            -->
            <div class="navbar-tools" aria-label="Sayfa ayarları">
                <div class="toolbar-shell">
                    <!-- Dil Seçimi Düğmesi -->
                    <button
                        class="tool-chip"
                        id="langToggle"
                        type="button"
                        aria-label="Dili değiştir"
                        title="İngilizce ve Türkçe arasında geçiş yap"
                    >
                        <span class="tool-label">TR</span>
                    </button>

                    <!-- Tema Seçimi Düğmesi -->
                    <button
                        class="tool-chip"
                        id="themeToggle"
                        type="button"
                        aria-label="Temayı değiştir"
                        title="Koyu ve açık tema arasında geçiş yap"
                    >
                        <span class="tool-label">☾</span>
                    </button>
                </div>
            </div>

        </div>
    </nav>
</header>