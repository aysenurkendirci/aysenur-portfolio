<?php
/*
    data.php dosyası portfolyo içeriğini yönetir.
    Profil bilgileri, about metinleri, teknolojiler, deneyimler ve projeler
    bu dosyadan dinamik olarak alınır.
*/
include 'data.php';

/*
    e() fonksiyonu ekrana yazdırılan dinamik verileri güvenli hale getirir.
    Bu yapı HTML doğruluğu ve güvenli çıktı üretmek için kullanılır.
*/
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Türkçe karakterlerin doğru görünmesi için UTF-8 karakter seti kullanılır. -->
    <meta charset="UTF-8">

    <!-- Mobil cihazlarda sayfanın doğru ölçeklenmesini sağlar. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tarayıcı sekmesinde görünen başlık. -->
    <title>Ayşe Nur Kendirci | Personal Portfolio</title>

    <!-- Font Awesome ikon kütüphanesi contact alanındaki ikonlar için kullanılır. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Devicon teknoloji ikonları için kullanılır. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Projenin ana CSS dosyası. Diğer CSS dosyaları style.css içinden çağrılır. -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <!-- Dekoratif mouse ışık efekti. İçerik anlamı taşımadığı için aria-hidden kullanılır. -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Üst menü ayrı dosyada tutulur. -->
    <?php include 'includes/navbar.php'; ?>

    <!-- main etiketi sayfanın ana içeriğini kapsar ve semantic HTML için önemlidir. -->
    <main>
        <!-- HERO SECTION -->
        <section id="home" class="hero hero-split" aria-labelledby="hero-title">
            <div class="hero-bg-word" aria-hidden="true">PORTFOLIO</div>

            <div class="container hero-split-layout">
                <div class="hero-left">
                    <p class="intro-line">Hello, I'm</p>

                    <h1 id="hero-title" class="hero-name">
                        <span>Ayşe Nur</span>
                        <span>Kendirci</span>
                    </h1>

                    <p class="hero-role"
                       data-en="<?= e($profile["title"]["en"]); ?>"
                       data-tr="<?= e($profile["title"]["tr"]); ?>">
                        <?= e($profile["title"]["en"]); ?>
                    </p>

                    <p class="hero-description"
                       data-en="<?= e($profile["description"]["en"]); ?>"
                       data-tr="<?= e($profile["description"]["tr"]); ?>">
                        <?= e($profile["description"]["en"]); ?>
                    </p>

                    <div class="hero-buttons">
                        <a href="#projects" class="btn" data-en="View Projects" data-tr="Projeleri Gör">
                            View Projects
                        </a>

                        <a href="<?= e($profile["cv"]); ?>"
                           class="btn btn-secondary"
                           target="_blank"
                           rel="noopener noreferrer"
                           data-en="Download CV"
                           data-tr="CV İndir">
                            Download CV
                        </a>
                    </div>

                    <div class="hero-social-icons" aria-label="Social media links">
                        <a href="<?= e($profile["github"]); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="GitHub profile">
                            <i class="devicon-github-original" aria-hidden="true"></i>
                        </a>

                        <a href="<?= e($profile["linkedin"]); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="LinkedIn profile">
                            <i class="devicon-linkedin-plain" aria-hidden="true"></i>
                        </a>

                        <a href="mailto:<?= e($profile["email"]); ?>" aria-label="Send email">
                            <span aria-hidden="true">@</span>
                        </a>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="swing-wrapper">
                        <div class="swing-line" aria-hidden="true"></div>

                        <article class="portfolio-card">
                            <div class="portfolio-card-header" aria-hidden="true"></div>

                            <div class="portfolio-card-image">
                                <img src="<?= e($profile["image"]); ?>"
                                     alt="Portrait of <?= e($profile["name"]); ?>">
                            </div>

                            <div class="portfolio-card-footer">
                                <h2><?= e($profile["name"]); ?></h2>

                                <p data-en="<?= e($profile["title"]["en"]); ?>"
                                   data-tr="<?= e($profile["title"]["tr"]); ?>">
                                    <?= e($profile["title"]["en"]); ?>
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- ABOUT SECTION -->
        <section id="about" class="about section" aria-labelledby="about-title">
            <div class="container">
                <h2 id="about-title" class="section-title" data-en="About Me" data-tr="Hakkımda">
                    About Me
                </h2>

                <div class="about-content">
                    <?php foreach ($aboutTexts as $paragraph): ?>
                        <p data-en="<?= e($paragraph["en"]); ?>"
                           data-tr="<?= e($paragraph["tr"]); ?>">
                            <?= e($paragraph["en"]); ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- SKILLS SECTION -->
        <section id="skills" class="skills section" aria-labelledby="skills-title">
            <div class="container">
                <h2 id="skills-title" class="section-title" data-en="Tech Stack" data-tr="Teknoloji Yığını">
                    Tech Stack
                </h2>

                <div class="tech-categories">
                    <?php foreach ($techCategories as $category): ?>
                        <article class="tech-category-card">
                            <h3 data-en="<?= e($category["title"]["en"]); ?>"
                                data-tr="<?= e($category["title"]["tr"]); ?>">
                                <?= e($category["title"]["en"]); ?>
                            </h3>

                            <ul class="tech-list">
                                <?php foreach ($category["items"] as $item): ?>
                                    <li class="tech-item" data-tooltip="<?= e($item["tooltip"]); ?>">
                                        <span class="tech-icon" aria-hidden="true">
                                            <?php if (!empty($item["icon"])): ?>
                                                <i class="<?= e($item["icon"]); ?>"></i>
                                            <?php else: ?>
                                                <?= e($item["iconText"]); ?>
                                            <?php endif; ?>
                                        </span>

                                        <span class="tech-name">
                                            <?= e($item["name"]); ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- EXPERIENCE SECTION -->
        <section id="experience" class="experience section" aria-labelledby="experience-title">
            <div class="container">
                <h2 id="experience-title" class="section-title" data-en="Experience" data-tr="Deneyim">
                    Experience
                </h2>

                <div class="experience-list">
                    <?php foreach ($experiences as $experience): ?>
                        <article class="experience-card">
                            <p class="experience-date"><?= e($experience["date"]); ?></p>

                            <div class="experience-content">
                                <h3><?= e($experience["title"]); ?></h3>
                                <p class="experience-company"><?= e($experience["company"]); ?></p>
                                <p><?= e($experience["description"]); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- PROJECTS SECTION -->
        <section id="projects" class="projects section" aria-labelledby="projects-title">
            <div class="container">
                <h2 id="projects-title" class="section-title" data-en="Projects" data-tr="Projeler">
                    Projects
                </h2>

                <div class="projects-grid">
                    <?php foreach ($projects as $project): ?>
                        <article class="project-card">
                            <h3><?= e($project["title"]); ?></h3>

                            <p data-en="<?= e($project["description"]["en"]); ?>"
                               data-tr="<?= e($project["description"]["tr"]); ?>">
                                <?= e($project["description"]["en"]); ?>
                            </p>

                            <ul class="tech-stack" aria-label="Project technologies">
                                <?php foreach ($project["tech"] as $tech): ?>
                                    <li class="tech"><?= e($tech); ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <a href="<?= e($project["github"]); ?>"
                               class="project-link"
                               target="_blank"
                               rel="noopener noreferrer"
                               data-en="View Project →"
                               data-tr="Projeyi Gör →">
                                View Project →
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- MORE PROJECTS SECTION -->
        <section class="more-projects section" aria-labelledby="more-projects-title">
            <div class="container">
                <div class="more-projects-box">
                    <h2 id="more-projects-title" class="section-title"
                        data-en="More on GitHub"
                        data-tr="GitHub'da Daha Fazlası">
                        More on GitHub
                    </h2>

                    <p data-en="In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies."
                       data-tr="Öne çıkan projelerime ek olarak Swift, ASP.NET, frontend geliştirme ve ilgili teknolojilerde daha küçük öğrenme odaklı depolar, mini uygulamalar ve pratik projeler de geliştiriyorum.">
                        In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies.
                    </p>

                    <a href="<?= e($profile["github"]); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn"
                       data-en="Explore All Repositories"
                       data-tr="Tüm Depoları Gör">
                        Explore All Repositories
                    </a>
                </div>
            </div>
        </section>
<!-- CONTACT SECTION -->
<section id="contact" class="contact section" aria-labelledby="contact-title">
    <div class="container">
        <h2 id="contact-title" class="section-title" data-en="Contact" data-tr="İletişim">
            Contact
        </h2>

        <p class="contact-intro"
           data-en="I am open to internship opportunities, junior developer roles and meaningful project collaborations."
           data-tr="Staj fırsatlarına, junior geliştirici pozisyonlarına ve anlamlı proje iş birliklerine açığım.">
            I am open to internship opportunities, junior developer roles and meaningful project collaborations.
        </p>

        <div class="contact-wrapper">
            <aside class="contact-info-card" aria-label="Contact information">
                <div class="contact-info-list">
                    <a class="contact-info-item" href="mailto:<?= e($profile["email"]); ?>">
                        <span class="contact-icon email-icon" aria-hidden="true">
                            <i class="fa-solid fa-envelope"></i>
                        </span>

                        <span>
                            <small data-en="Email" data-tr="E-posta">Email</small>
                            <strong><?= e($profile["email"]); ?></strong>
                        </span>
                    </a>

                    <a class="contact-info-item"
                       href="<?= e($profile["github"]); ?>"
                       target="_blank"
                       rel="noopener noreferrer">
                        <span class="contact-icon github-icon" aria-hidden="true">
                            <i class="fa-brands fa-github"></i>
                        </span>

                        <span>
                            <small>GitHub</small>
                            <strong data-en="View repositories" data-tr="Depoları görüntüle">
                                View repositories
                            </strong>
                        </span>
                    </a>

                    <a class="contact-info-item"
                       href="<?= e($profile["linkedin"]); ?>"
                       target="_blank"
                       rel="noopener noreferrer">
                        <span class="contact-icon linkedin-icon" aria-hidden="true">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </span>

                        <span>
                            <small>LinkedIn</small>
                            <strong data-en="Connect with me" data-tr="Benimle bağlantı kurun">
                                Connect with me
                            </strong>
                        </span>
                    </a>
                </div>
            </aside>

            <form class="contact-form" action="process-form.php" method="post">
                <div class="form-group">
                    <label for="name" data-en="Name" data-tr="Ad Soyad">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>
                </div>

                <div class="form-group">
                    <label for="email" data-en="Email" data-tr="E-posta">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label for="message" data-en="Message" data-tr="Mesaj">Message</label>
                    <textarea id="message" name="message" rows="6" placeholder="Write your message..." required></textarea>
                </div>

                <button type="submit" class="btn contact-submit">
                    <span data-en="Send Message" data-tr="Mesaj Gönder">Send Message</span>
                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>
</section>
    </main>

    <!-- Footer ayrı dosyada tutulur. -->
    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript dosyası sayfa sonunda çağrılır. -->
    <script src="js/script.js"></script>
</body>
</html>