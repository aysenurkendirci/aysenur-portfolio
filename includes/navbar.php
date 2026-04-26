<!-- 
    NAVBAR (Üst Menü)
    Sayfanın en üstünde bulunan navigasyon alanıdır.
    Kullanıcı buradan sayfa içindeki bölümlere geçiş yapar.
-->
<nav class="navbar">

    <!-- 
        Container:
        Navbar içeriğini ortalar ve sayfa ile hizalar
    -->
    <div class="container navbar-container">

        <!-- 
            BRAND (Logo yerine kullanılan alan)
            Kod yazıyormuş gibi görünen animasyonlu isim alanı
        -->
        <a href="#home" class="brand">

            <!-- 
                brand-line:
                CSS ile typing (yazı yazılıyor) animasyonu uygulanır
            -->
            <div class="brand-line">

                <!-- "const" keyword (renklendirme için ayrı span) -->
                <span class="token-const">const</span>

                <!-- değişken adı -->
                <span class="token-var">developer</span>

                <!-- eşittir işareti -->
                <span class="token-eq">=</span>

                <!-- string değer (isim) -->
                <span class="token-string">"Ayşe Nur Kendirci"</span>

                <!-- noktalı virgül -->
                <span class="token-semi">;</span>

                <!-- 
                    Yanıp sönen cursor
                    Kod yazılıyormuş hissi verir
                -->
                <span class="brand-cursor"></span>
            </div>
        </a>

        <!-- 
            MENU TOGGLE (Mobil Menü Butonu)
            Küçük ekranlarda hamburger menü açıp kapatır
            JS ile nav-links görünürlüğü kontrol edilir
        -->
        <button class="menu-toggle" id="menuToggle">☰</button>

        <!-- 
            NAV LINKS (Menü Linkleri)
            Kullanıcıyı sayfa içindeki bölümlere götürür
        -->
        <ul class="nav-links" id="navLinks">

            <!-- About bölümü -->
            <li><a href="#about">About</a></li>

            <!-- Tech Stack bölümü -->
            <li><a href="#skills">Tech Stack</a></li>

            <!-- Projects bölümü -->
            <li><a href="#projects">Projects</a></li>

            <!-- Contact bölümü -->
            <li><a href="#contact">Contact</a></li>

            <!-- 
                CV linki
                PHP ile dinamik olarak profile içinden alınır
                target="_blank" yeni sekmede açar
            -->
            <li>
                <a href="<?= $profile["cv"]; ?>" target="_blank">
                    CV
                </a>
            </li>
        </ul>

        <!-- 
            NAVBAR TOOLS (Sağ taraf butonları)
            Tema ve dil değiştirme butonlarını içerir
        -->
        <div class="navbar-tools">

            <!-- 
                toolbar-shell:
                Butonları tek kutu içinde gösterir
            -->
            <div class="toolbar-shell">

                <!-- 
                    Dil değiştirme butonu
                    JS ile TR / EN değişir
                -->
                <button class="tool-chip" id="langToggle">
                    <span class="tool-label">TR</span>
                </button>

                <!-- 
                    Tema değiştirme butonu
                    JS ile dark / light mode değişir
                -->
                <button class="tool-chip" id="themeToggle">
                    <span class="tool-label">☀</span>
                </button>

            </div>
        </div>

    </div>
</nav>