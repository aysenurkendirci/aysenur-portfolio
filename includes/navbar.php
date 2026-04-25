<nav class="navbar">
    <div class="container navbar-container">

        <a href="#home" class="brand">
            <div class="brand-line">
                <span class="token-const">const</span>
                <span class="token-var">developer</span>
                <span class="token-eq">=</span>
                <span class="token-string">"Ayşe Nur Kendirci"</span>
                <span class="token-semi">;</span>
                <span class="brand-cursor"></span>
            </div>
        </a>

        <button class="menu-toggle" id="menuToggle">☰</button>

        <ul class="nav-links" id="navLinks">
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Tech Stack</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="<?= $profile["cv"]; ?>" target="_blank">CV</a></li>
        </ul>

        <div class="navbar-tools">
            <div class="toolbar-shell">
                <button class="tool-chip" id="langToggle">
                    <span class="tool-label">TR</span>
                </button>

                <button class="tool-chip" id="themeToggle">
                    <span class="tool-label">☀</span>
                </button>
            </div>
        </div>

    </div>
</nav>