<!-- 
    NAVBAR
    Sayfanın üst bölümündeki ana navigasyon alanıdır.
    Kullanıcı bu bölümden sayfa içindeki ana alanlara geçiş yapabilir.
-->
<header class="site-header">
    <nav class="navbar" aria-label="Main navigation">
        <div class="container navbar-container">

            <!-- Brand alanı: Portfolyo sahibinin ismini kod yazımı görünümünde gösterir. -->
            <a href="index.php#home" class="brand" aria-label="Go to home section">
                <span class="brand-line">
                    <span class="token-const">const</span>
                    <span class="token-var">developer</span>
                    <span class="token-eq">=</span>
                    <span class="token-string">"Ayşe Nur Kendirci"</span>
                    <span class="token-semi">;</span>
                    <span class="brand-cursor" aria-hidden="true"></span>
                </span>
            </a>

            <!-- Mobil ekranlarda menüyü açıp kapatan butondur. -->
            <button
                class="menu-toggle"
                id="menuToggle"
                type="button"
                aria-label="Open navigation menu"
                aria-controls="navLinks"
                aria-expanded="false"
            >
                <span aria-hidden="true">☰</span>
            </button>

            <!-- Sayfa içi navigasyon linkleri. -->
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#skills">Tech Stack</a></li>
                <li><a href="index.php#experience">Experience</a></li>
                <li><a href="index.php#projects">Projects</a></li>
                <li><a href="index.php#contact">Contact</a></li>

                <li>
                    <a
                        href="<?= e($profile["cv"]); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        CV
                    </a>
                </li>
            </ul>

            <!-- Dil ve tema değiştirme araçları. -->
            <div class="navbar-tools" aria-label="Page settings">
                <div class="toolbar-shell">
                    <button
                        class="tool-chip"
                        id="langToggle"
                        type="button"
                        aria-label="Change language"
                    >
                        <span class="tool-label">TR</span>
                    </button>

                    <button
                        class="tool-chip"
                        id="themeToggle"
                        type="button"
                        aria-label="Change theme"
                    >
                        <span class="tool-label">☀</span>
                    </button>
                </div>
            </div>

        </div>
    </nav>
</header>