<!-- 
    NAVIGATION BAR
    Main navigation header with logo, menu links, and theme/language toggles.
    This component is included on all pages for consistent navigation.
    Semantic <header> and <nav> elements are used for proper document structure.
-->
<header class="site-header" role="banner">
    <nav class="navbar" aria-label="Main navigation">
        <div class="container navbar-container">

            <!-- Brand/Logo: Displays developer name in code style -->
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

            <!-- Mobile menu toggle button -->
            <!-- Visible on small screens, controls mobile navigation menu -->
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

            <!-- Navigation links list -->
            <!-- Links to different sections of the portfolio -->
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php#about" data-en="About" data-tr="Hakkımda">About</a></li>
                <li><a href="index.php#skills" data-en="Tech Stack" data-tr="Teknolojiler">Tech Stack</a></li>
                <li><a href="index.php#experience" data-en="Experience" data-tr="Deneyim">Experience</a></li>
                <li><a href="index.php#projects" data-en="Projects" data-tr="Projeler">Projects</a></li>
                <li><a href="index.php#contact" data-en="Contact" data-tr="İletişim">Contact</a></li>

                <!-- CV download link -->
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

            <!-- Toolbar with theme and language toggles -->
            <!-- Settings for visual theme and language preference -->
            <div class="navbar-tools" aria-label="Page settings">
                <div class="toolbar-shell">
                    <!-- Language toggle button -->
                    <button
                        class="tool-chip"
                        id="langToggle"
                        type="button"
                        aria-label="Change language"
                        title="Toggle between English and Turkish"
                    >
                        <span class="tool-label">TR</span>
                    </button>

                    <!-- Theme toggle button -->
                    <button
                        class="tool-chip"
                        id="themeToggle"
                        type="button"
                        aria-label="Change theme"
                        title="Toggle between dark and light theme"
                    >
                        <span class="tool-label">☾</span>
                    </button>
                </div>
            </div>

        </div>
    </nav>
</header>