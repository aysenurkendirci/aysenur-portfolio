<nav class="navbar">
    <div class="container navbar-container">
        <a href="#home" class="brand" aria-label="Go to home section">
            <span class="brand-prefix">&lt;code&gt;</span>
            <span class="brand-name">Ayşe Nur Kendirci</span>
            <span class="brand-cursor"></span>
            <span class="brand-suffix">&lt;/code&gt;</span>
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Open navigation menu">
            ☰
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="#about" data-en="About" data-tr="Hakkımda">About</a></li>
            <li><a href="#skills" data-en="Tech Stack" data-tr="Teknolojiler">Tech Stack</a></li>
            <li><a href="#projects" data-en="Projects" data-tr="Projeler">Projects</a></li>
            <li><a href="#contact" data-en="Contact" data-tr="İletişim">Contact</a></li>
            <li><a href="<?= $profile["cv"]; ?>" target="_blank" data-en="CV" data-tr="CV">CV</a></li>
        </ul>

        <div class="navbar-tools">
            <div class="toolbar-shell">
                <button class="tool-chip" id="langToggle" type="button" aria-label="Change language">
                    <span class="tool-label">TR</span>
                </button>

                <button class="tool-chip" id="themeToggle" type="button" aria-label="Change theme">
                    <span class="tool-label">☀</span>
                </button>
            </div>

            <a href="<?= $profile["github"]; ?>" target="_blank" class="github-pill">
                <i class="devicon-github-original"></i>
                <span>GitHub</span>
            </a>
        </div>
    </div>
</nav>