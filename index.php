<?php
/*
    data.php dosyasını bu sayfaya dahil ediyoruz.
    Profil bilgileri, about metinleri, teknoloji listesi ve projeler
    bu dosyadan geliyor.
*/
include 'data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Türkçe karakterlerin doğru görünmesi için UTF-8 kullanılır -->
    <meta charset="UTF-8">

    <!-- Sayfanın mobil cihazlarda düzgün ölçeklenmesi için gereklidir -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tarayıcı sekmesinde görünen başlık -->
    <title>Ayşe Nur Kendirci | Personal Portfolio</title>

    <!-- Teknoloji ikonları için Devicon kütüphanesi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Projenin ana CSS dosyası -->
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- Sayfa başlangıçta koyu tema ile açılır -->
<body class="dark-theme">

<!-- Mouse hareketine göre çalışan arka plan ışık efekti -->
<div class="cursor-glow" id="cursorGlow"></div>

<!-- Navbar ayrı dosyada tutulduğu için burada include edilir -->
<?php include 'includes/navbar.php'; ?>

<!-- 
    main etiketi sayfanın ana içeriğini kapsar.
    Semantic HTML açısından önemlidir.
-->
<main>

    <!-- HERO SECTION: Kullanıcının ilk gördüğü ana tanıtım alanı -->
    <section id="home" class="hero hero-split">

        <!-- Dekoratif büyük arka plan yazısı -->
        <div class="hero-bg-word">PORTFOLIO</div>

        <!-- Hero içeriğini iki kolona bölen container -->
        <div class="container hero-split-layout">

            <!-- Sol tarafta isim, açıklama ve butonlar yer alır -->
            <div class="hero-left">
                <p class="intro-line">Hello, I'm</p>

                <h1 class="hero-name">
                    <span>Ayşe Nur</span>
                    <span>Kendirci</span>
                </h1>

                <!-- 
                    data-en ve data-tr attribute'ları dil değiştirme özelliği için kullanılır.
                    JavaScript seçilen dile göre bu metni değiştirir.
                -->
                <h2 class="hero-role"
                    data-en="<?= htmlspecialchars($profile["title"]["en"]); ?>"
                    data-tr="<?= htmlspecialchars($profile["title"]["tr"]); ?>">
                    <?= htmlspecialchars($profile["title"]["en"]); ?>
                </h2>

                <p class="hero-description"
                   data-en="<?= htmlspecialchars($profile["description"]["en"]); ?>"
                   data-tr="<?= htmlspecialchars($profile["description"]["tr"]); ?>">
                    <?= htmlspecialchars($profile["description"]["en"]); ?>
                </p>

                <!-- Hero alanındaki aksiyon butonları -->
                <div class="hero-buttons">
                    <a href="#projects" class="btn" data-en="View Projects" data-tr="Projeleri Gör">
                        View Projects
                    </a>

                    <a href="<?= htmlspecialchars($profile["cv"]); ?>" target="_blank" class="btn btn-secondary" data-en="Download CV" data-tr="CV İndir">
                        Download CV
                    </a>
                </div>

                <!-- Sosyal medya bağlantıları -->
                <div class="hero-social-icons">
                    <a href="<?= htmlspecialchars($profile["github"]); ?>" target="_blank" aria-label="GitHub">
                        <i class="devicon-github-original"></i>
                    </a>

                    <a href="<?= htmlspecialchars($profile["linkedin"]); ?>" target="_blank" aria-label="LinkedIn">
                        <i class="devicon-linkedin-plain"></i>
                    </a>

                    <a href="mailto:<?= htmlspecialchars($profile["email"]); ?>" aria-label="Email">
                        <span>@</span>
                    </a>
                </div>
            </div>

            <!-- Sağ tarafta profil kartı bulunur -->
            <div class="hero-right">
                <div class="swing-wrapper">

                    <!-- Kartın asılı duruyormuş gibi görünmesini sağlayan çizgi -->
                    <div class="swing-line"></div>

                    <!-- Profil kartı -->
                    <div class="portfolio-card">
                        <div class="portfolio-card-header"></div>

                        <div class="portfolio-card-image">
                            <img src="<?= htmlspecialchars($profile["image"]); ?>" alt="Portrait of <?= htmlspecialchars($profile["name"]); ?>">
                        </div>

                        <div class="portfolio-card-footer">
                            <h3><?= htmlspecialchars($profile["name"]); ?></h3>

                            <p data-en="<?= htmlspecialchars($profile["title"]["en"]); ?>"
                               data-tr="<?= htmlspecialchars($profile["title"]["tr"]); ?>">
                                <?= htmlspecialchars($profile["title"]["en"]); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ABOUT SECTION: Kişisel açıklama alanı -->
    <section id="about" class="about section">
        <div class="container">
            <h2 class="section-title" data-en="About Me" data-tr="Hakkımda">
                About Me
            </h2>

            <div class="about-content">
                <!-- 
                    About metinleri data.php dosyasındaki $aboutTexts dizisinden gelir.
                    foreach kullanarak tekrar eden paragraf yapısı dinamik oluşturulur.
                -->
                <?php foreach ($aboutTexts as $paragraph): ?>
                    <p data-en="<?= htmlspecialchars($paragraph["en"]); ?>"
                       data-tr="<?= htmlspecialchars($paragraph["tr"]); ?>">
                        <?= htmlspecialchars($paragraph["en"]); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SKILLS SECTION: Teknoloji bilgileri -->
    <section id="skills" class="skills section">
        <div class="container">
            <h2 class="section-title" data-en="Tech Stack" data-tr="Teknoloji Yığını">
                Tech Stack
            </h2>

            <div class="tech-categories">
                <!-- 
                    Teknoloji kategorileri data.php içindeki $techCategories dizisinden gelir.
                    Her kategori için ayrı bir kart oluşturulur.
                -->
                <?php foreach ($techCategories as $category): ?>
                    <div class="tech-category-card">
                        <h3 data-en="<?= htmlspecialchars($category["title"]["en"]); ?>"
                            data-tr="<?= htmlspecialchars($category["title"]["tr"]); ?>">
                            <?= htmlspecialchars($category["title"]["en"]); ?>
                        </h3>

                        <div class="tech-grid">
                            <!-- Her kategori içindeki teknolojiler listelenir -->
                            <?php foreach ($category["items"] as $item): ?>
                                <div class="tech-item"
                                     data-tooltip-en="<?= htmlspecialchars($item['tooltip']['en']); ?>"
                                     data-tooltip-tr="<?= htmlspecialchars($item['tooltip']['tr']); ?>">
                                    <i class="<?= htmlspecialchars($item['icon']); ?>"></i>
                                    <span><?= htmlspecialchars($item['name']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION: Proje kartları -->
    <section id="projects" class="projects section">
        <div class="container">
            <h2 class="section-title" data-en="Featured Projects" data-tr="Öne Çıkan Projeler">
                Featured Projects
            </h2>

            <div class="projects-grid">
                <!-- 
                    article etiketi kullanılması semantic HTML açısından uygundur.
                    Çünkü her proje bağımsız bir içerik kartıdır.
                -->
                <?php foreach ($projects as $project): ?>
                    <article class="project-card">
                        <h3><?= htmlspecialchars($project["title"]); ?></h3>

                        <p data-en="<?= htmlspecialchars($project["description"]["en"]); ?>"
                           data-tr="<?= htmlspecialchars($project["description"]["tr"]); ?>">
                            <?= htmlspecialchars($project["description"]["en"]); ?>
                        </p>

                        <!-- Projede kullanılan teknolojiler etiket olarak gösterilir -->
                        <div class="tech-stack">
                            <?php foreach ($project["tech"] as $tech): ?>
                                <span class="tech"><?= htmlspecialchars($tech); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <a href="<?= htmlspecialchars($project["github"]); ?>" target="_blank" class="project-link"
                           data-en="View Repository →" data-tr="Depoyu Gör →">
                            View Repository →
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- MORE PROJECTS SECTION: GitHub yönlendirme alanı -->
    <section class="more-projects section">
        <div class="container">
            <div class="more-projects-box">
                <h2 class="section-title" data-en="More on GitHub" data-tr="GitHub'da Daha Fazlası">
                    More on GitHub
                </h2>

                <p data-en="In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies."
                   data-tr="Öne çıkan projelerime ek olarak Swift, ASP.NET, frontend geliştirme ve ilgili teknolojilerde daha küçük öğrenme odaklı depolar, mini uygulamalar ve pratik projeler de geliştiriyorum.">
                    In addition to my featured projects, I also build smaller learning-focused repositories, mini applications and practice projects in Swift, ASP.NET, frontend development and related technologies.
                </p>

                <a href="<?= htmlspecialchars($profile["github"]); ?>" target="_blank" class="btn"
                   data-en="Explore All Repositories" data-tr="Tüm Depoları Gör">
                    Explore All Repositories
                </a>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION: Kullanıcı mesaj formu -->
    <section id="contact" class="contact section">
        <div class="container">
            <h2 class="section-title" data-en="Contact" data-tr="İletişim">
                Contact
            </h2>

            <!-- 
                Form POST yöntemiyle process-form.php dosyasına gönderilir.
                label ve input eşleşmeleri accessibility ve HTML kriterleri için önemlidir.
            -->
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

                <button type="submit" class="btn" data-en="Send Message" data-tr="Mesaj Gönder">
                    Send Message
                </button>
            </form>
        </div>
    </section>

</main>

<!-- Footer ayrı dosyada tutulduğu için include edilir -->
<?php include 'includes/footer.php'; ?>

<!-- Sayfanın etkileşimlerini yöneten JavaScript dosyası -->
<script src="js/script.js"></script>

</body>
</html>