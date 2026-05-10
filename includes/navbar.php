<!-- 
    NAVİGASYON ÇUBUĞU
    Logo, menü linkleri ve tema/dil değiştirme düğmeleri içeren ana navigasyon başlığı.
    Bu bileşen tüm sayfaların başında dahil edilir ve tutarlı navigasyon sağlar.
    Uygun belge yapısı için semantik <header> ve <nav> öğeleri kullanılır.
-->
<header class="site-header" role="banner">
    <nav class="navbar" aria-label="Ana navigasyon">
        <div class="container navbar-container">

            <!-- Marka/Logo: Kod yazımı stilinde geliştirici adını gösterir -->
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

            <!-- Mobil Menü Aç/Kapa Düğmesi -->
            <!-- Küçük ekranlarda görünür, mobil navigasyon menüsünü kontrol eder -->
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

            <!-- Navigasyon Linkleri Listesi -->
            <!-- Portföyün farklı bölümlerine gitmek için linkler -->
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php#about" data-en="About" data-tr="Hakkımda">About</a></li>
                <li><a href="index.php#skills" data-en="Tech Stack" data-tr="Teknolojiler">Tech Stack</a></li>
                <li><a href="index.php#experience" data-en="Experience" data-tr="Deneyim">Experience</a></li>
                <li><a href="index.php#projects" data-en="Projects" data-tr="Projeler">Projects</a></li>
                <li><a href="index.php#contact" data-en="Contact" data-tr="İletişim">Contact</a></li>

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

            <!-- Tema ve Dil Değiştirme Araçları Çubuğu -->
            <!-- Görsel tema ve dil tercihi ayarları -->
            <div class="navbar-tools" aria-label="Sayfa ayarları">
                <div class="toolbar-shell">
                    <!-- Dil Değiştirme Düğmesi -->
                    <button
                        class="tool-chip"
                        id="langToggle"
                        type="button"
                        aria-label="Dili değiştir"
                        title="İngilizce ve Türkçe arasında geçiş yap"
                    >
                        <span class="tool-label">TR</span>
                    </button>

                    <!-- Tema Değiştirme Düğmesi -->
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