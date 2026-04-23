<?php include 'data.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayşe Nur Kendirci | Personal Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dark-theme">
<div class="cursor-glow" id="cursorGlow"></div>

<?php include 'includes/navbar.php'; ?>

<main>
    <section id="home" class="hero hero-split">
        <div class="hero-bg-word">PORTFOLIO</div>

        <div class="container hero-split-layout">
            <div class="hero-left">
                <p class="intro-line">Hello, I'm</p>

                <h1 class="hero-name">
                    <span>Ayşe Nur</span>
                    <span>Kendirci</span>
                </h1>

                <h2 class="hero-role"
                    data-en="<?= htmlspecialchars($profile["title"]["en"]); ?>"
                    data-tr="<?= htmlspecialchars($profile["title"]["tr"]); ?>">
                    <?= $profile["title"]["en"]; ?>
                </h2>

                <p class="hero-description"
                   data-en="<?= htmlspecialchars($profile["description"]["en"]); ?>"
                   data-tr="<?= htmlspecialchars($profile["description"]["tr"]); ?>">
                    <?= $profile["description"]["en"]; ?>
                </p>

                <div class="hero-buttons">
                    <a href="#projects" class="btn" data-en="View Projects" data-tr="Projeleri Gör">View Projects</a>
                    <a href="<?= $profile["cv"]; ?>" target="_blank" class="btn btn-secondary" data-en="Download CV" data-tr="CV İndir">Download CV</a>
                </div>

                <div class="hero-social-icons">
                    <a href="<?= $profile["github"]; ?>" target="_blank" aria-label="GitHub">
                        <i class="devicon-github-original"></i>
                    </a>
                    <a href="<?= $profile["linkedin"]; ?>" target="_blank" aria-label="LinkedIn">
                        <i class="devicon-linkedin-plain"></i>
                    </a>
                    <a href="mailto:<?= $profile["email"]; ?>" aria-label="Email">
                        <span>@</span>
                    </a>
                </div>
            </div>

            <div class="hero-right">
                <div class="swing-wrapper">
                    <div class="swing-line"></div>

                    <div class="portfolio-card">
                        <div class="portfolio-card-header"></div>

                        <div class="portfolio-card-image">
                            <img src="<?= $profile["image"]; ?>" alt="Portrait of <?= $profile["name"]; ?>">
                        </div>

                        <div class="portfolio-card-footer">
                            <h3><?= $profile["name"]; ?></h3>
                            <p data-en="<?= htmlspecialchars($profile["title"]["en"]); ?>"
                               data-tr="<?= htmlspecialchars($profile["title"]["tr"]); ?>">
                                <?= $profile["title"]["en"]; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="hero-side-panel">
                    <?php foreach ($quickInfo as $item): ?>
                        <div class="info-box">
                            <span class="info-label"
                                  data-en="<?= htmlspecialchars($item["label"]["en"]); ?>"
                                  data-tr="<?= htmlspecialchars($item["label"]["tr"]); ?>">
                                <?= $item["label"]["en"]; ?>
                            </span>
                            <strong
                                data-en="<?= htmlspecialchars($item["value"]["en"]); ?>"
                                data-tr="<?= htmlspecialchars($item["value"]["tr"]); ?>">
                                <?= $item["value"]["en"]; ?>
                            </strong>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title" data-en="About Me" data-tr="Hakkımda">About Me</h2>

            <div class="about-content">
                <?php foreach ($aboutTexts as $paragraph): ?>
                    <p data-en="<?= htmlspecialchars($paragraph["en"]); ?>" data-tr="<?= htmlspecialchars($paragraph["tr"]); ?>">
                        <?= $paragraph["en"]; ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="skills" class="skills section">
        <div class="container">
            <h2 class="section-title" data-en="Tech Stack" data-tr="Teknoloji Yığını">Tech Stack</h2>

            <div class="tech-categories">
                <?php foreach ($techCategories as $category): ?>
                    <div class="tech-category-card">
                        <h3 data-en="<?= htmlspecialchars($category["title"]["en"]); ?>" data-tr="<?= htmlspecialchars($category["title"]["tr"]); ?>">
                            <?= $category["title"]["en"]; ?>
                        </h3>

                        <div class="tech-grid">
                            <?php foreach ($category["items"] as $item): ?>
                                <div class="tech-item"
                                     data-tooltip-en="<?= htmlspecialchars($item['tooltip']['en']); ?>"
                                     data-tooltip-tr="<?= htmlspecialchars($item['tooltip']['tr']); ?>">
                                    <i class="<?= $item['icon']; ?>"></i>
                                    <span><?= $item['name']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="projects" class="projects section">
        <div class="container">
            <h2 class="section-title" data-en="Featured Projects" data-tr="Öne Çıkan Projeler">Featured Projects</h2>

            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <article class="project-card">
                        <h3><?= $project["title"]; ?></h3>

                        <p data-en="<?= htmlspecialchars($project["description"]["en"]); ?>" data-tr="<?= htmlspecialchars($project["description"]["tr"]); ?>">
                            <?= $project["description"]["en"]; ?>
                        </p>

                        <div class="tech-stack">
                            <?php foreach ($project["tech"] as $tech): ?>
                                <span class="tech"><?= $tech; ?></span>
                            <?php endforeach; ?>
                        </div>

                        <a href="<?= $project["github"]; ?>" target="_blank" class="project-link"
                           data-en="View Repository →" data-tr="Depoyu Gör →">
                            View Repository →
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="more-projects section">
        <div class="container">
            <div class="more-projects-box">
                <h2 class="section-title" data-en="More on GitHub" data-tr="GitHub'da Daha Fazlası">More on GitHub</h2>

                <p data-en="In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies."
                   data-tr="Öne çıkan projelerime ek olarak Swift, ASP.NET, frontend geliştirme ve ilgili teknolojilerde daha küçük öğrenme odaklı depolar, mini uygulamalar ve pratik projeler de geliştiriyorum.">
                    In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies.
                </p>

                <a href="<?= $profile["github"]; ?>" target="_blank" class="btn"
                   data-en="Explore All Repositories" data-tr="Tüm Depoları Gör">
                    Explore All Repositories
                </a>
            </div>
        </div>
    </section>

    <section id="contact" class="contact section">
        <div class="container">
            <h2 class="section-title" data-en="Contact" data-tr="İletişim">Contact</h2>

            <form action="process-form.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name" data-en="Name" data-tr="Ad Soyad">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email" data-en="Email" data-tr="E-posta">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message" data-en="Message" data-tr="Mesaj">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn" data-en="Send Message" data-tr="Mesaj Gönder">Send Message</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>