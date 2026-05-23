<?php
// data.php dosyasını projeye dahil eder.
// Profil bilgileri, hakkımda yazıları, teknolojiler, deneyimler, projeler ve iletişim formu verileri buradan gelir.
include 'data.php';

/**
 * Güvenlik Fonksiyonu: Çıkışı güvenli hale getirir.
 * Kullanıcıya gösterilecek verilerde özel karakterleri HTML entity formatına çevirir.
 * Böylece XSS saldırılarına karşı koruma sağlar.
 *
 * @param string $value Güvenli hale getirilecek değer
 * @return string HTML içinde güvenli şekilde basılabilecek değer
 */
function e($value)
{
    // htmlspecialchars özel karakterleri dönüştürür.
    // ENT_QUOTES hem tek hem çift tırnakları dönüştürür.
    // UTF-8 Türkçe karakterlerin bozulmadan çalışmasını sağlar.
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<!-- Sayfanın HTML5 standardında yazıldığını belirtir. -->

<html lang="en">
<!-- Sayfanın varsayılan dilini İngilizce olarak ayarlar. -->

<head>
    <!-- Sayfadaki karakterlerin UTF-8 formatında okunmasını sağlar. -->
    <meta charset="UTF-8">
    
    <!-- Sayfanın mobil, tablet ve masaüstü cihazlarda responsive görünmesini sağlar. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tarayıcı sekmesinde görünen başlığı belirler. -->
    <title>Ayşe Nur Kendirci | Kişisel Portföyü</title>

    <!-- Font Awesome ikon kütüphanesini projeye dahil eder. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Devicon teknoloji ikonları kütüphanesini projeye dahil eder. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <!-- Projenin ana CSS dosyasını sayfaya bağlar. -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Font Awesome CDN adresinin daha hızlı çözümlenmesini sağlar. -->
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- Devicon CDN adresinin daha hızlı çözümlenmesini sağlar. -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
</head>

<body class="dark-theme">
    <!-- Body etiketi sayfanın görünen tüm içeriğini kapsar. -->
    <!-- dark-theme sınıfı sayfanın varsayılan olarak koyu temada açılmasını sağlar. -->

    <!-- Erişilebilirlik için ana içeriğe hızlı geçiş linkidir. -->
    <!-- Ekran okuyucu ve klavye kullanan kullanıcılar navbarı atlayıp direkt ana içeriğe geçebilir. -->
    <a href="#main-content" class="sr-only" tabindex="1">
        <!-- Dil değişim sistemi için İngilizce ve Türkçe metinleri tutar. -->
        <span data-en="Skip to main content" data-tr="Ana içeriğe atla">
            Skip to main content
        </span>
    </a>

    <!-- Dekoratif imleç/parıltı efekti için kullanılan boş divdir. -->
    <!-- aria-hidden="true" ekran okuyucuların bu görsel öğeyi yok saymasını sağlar. -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Navbar dosyasını bu sayfaya dahil eder. -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Sayfanın ana içerik alanını başlatır. -->
    <main id="main-content">

        <!-- HERO BÖLÜMÜ: Sayfanın ilk açılış/tanıtım alanıdır. -->
        <section id="home" class="hero hero-split" aria-labelledby="hero-title">

            <!-- Arka planda dekoratif olarak görünen büyük PORTFOLIO yazısıdır. -->
            <div class="hero-bg-word" aria-hidden="true">PORTFOLIO</div>

            <!-- Hero içeriğini ortalayan ve iki sütunlu düzene alan containerdır. -->
            <div class="container hero-split-layout">

                <!-- Hero bölümünün sol tarafındaki yazı ve buton alanıdır. -->
                <div class="hero-left">

                    <!-- Giriş cümlesidir. -->
                    <p class="intro-line" data-en="Hello, I'm" data-tr="Merhaba, ben">
                        Hello, I'm
                    </p>

                    <!-- Ana başlık alanıdır. -->
                    <h1 id="hero-title" class="hero-name">
                        <!-- İsmin ilk satırını gösterir. -->
                        <span>Ayşe Nur</span>

                        <!-- Soyadını ikinci satırda gösterir. -->
                        <span>Kendirci</span>
                    </h1>

                    <!-- Profil başlığını data.php içinden çeker. -->
                    <p class="hero-role"
                       data-en="<?= e($profile["title"]["en"]); ?>"
                       data-tr="<?= e($profile["title"]["tr"]); ?>">
                        <?= e($profile["title"]["en"]); ?>
                    </p>

                    <!-- Profil açıklamasını data.php içinden çeker. -->
                    <p class="hero-description"
                       data-en="<?= e($profile["description"]["en"]); ?>"
                       data-tr="<?= e($profile["description"]["tr"]); ?>">
                        <?= e($profile["description"]["en"]); ?>
                    </p>

                    <!-- Hero bölümündeki butonları kapsar. -->
                    <div class="hero-buttons">

                        <!-- Projeler bölümüne sayfa içi geçiş yapar. -->
                        <a href="#projects" class="btn" data-en="View Projects" data-tr="Projeleri Gör">
                            View Projects
                        </a>

                        <!-- CV dosyasını yeni sekmede açar/indirir. -->
                        <a href="<?= e($profile["cv"]); ?>"
                           class="btn btn-secondary"
                           target="_blank"
                           rel="noopener noreferrer"
                           data-en="Download CV"
                           data-tr="CV İndir">
                            Download CV
                        </a>
                    </div>

                    <!-- Sosyal medya ikonlarının bulunduğu alan. -->
                    <div class="hero-social-icons" aria-label="Social media links">

                        <!-- GitHub profil linki. -->
                        <a href="<?= e($profile["github"]); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub profile">
                            <!-- GitHub ikonunu gösterir. -->
                            <i class="devicon-github-original" aria-hidden="true"></i>
                        </a>

                        <!-- LinkedIn profil linki. -->
                        <a href="<?= e($profile["linkedin"]); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile">
                            <!-- LinkedIn ikonunu gösterir. -->
                            <i class="devicon-linkedin-plain" aria-hidden="true"></i>
                        </a>

                        <!-- Mail uygulamasını açarak e-posta göndermeyi sağlar. -->
                        <a href="mailto:<?= e($profile["email"]); ?>" aria-label="Send email">
                            <!-- Görsel olarak @ sembolü gösterir. -->
                            <span aria-hidden="true">@</span>
                        </a>
                    </div>
                </div>

                <!-- Hero bölümünün sağ tarafındaki profil kartı alanıdır. -->
                <div class="hero-right">

                    <!-- Sallanan kart animasyonunun kapsayıcısıdır. -->
                    <div class="swing-wrapper">

                        <!-- Kartın yukarıdan asılıymış gibi görünmesini sağlayan çizgidir. -->
                        <div class="swing-line" aria-hidden="true"></div>

                        <!-- Profil kartı içeriğini kapsar. -->
                        <article class="portfolio-card">

                            <!-- Kartın üst dekoratif boşluk alanıdır. -->
                            <div class="portfolio-card-header" aria-hidden="true"></div>

                            <!-- Profil fotoğrafının bulunduğu alan. -->
                            <div class="portfolio-card-image">
                                <!-- Profil fotoğrafını data.php içinden çeker. -->
                                <img src="<?= e($profile["image"]); ?>" alt="Portrait of <?= e($profile["name"]); ?>">
                            </div>

                            <!-- Profil kartının alt yazı alanıdır. -->
                            <div class="portfolio-card-footer">

                                <!-- Profil adını data.php içinden çeker. -->
                                <h2><?= e($profile["name"]); ?></h2>

                                <!-- Profil unvanını gösterir. -->
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

        <!-- HAKKIMDA BÖLÜMÜ: Kişisel ve mesleki açıklama alanıdır. -->
        <section id="about" class="about section" aria-labelledby="about-title">

            <!-- Bölüm içeriğini ortalayan containerdır. -->
            <div class="container">

                <!-- Hakkımda bölüm başlığıdır. -->
                <h2 id="about-title" class="section-title" data-en="About Me" data-tr="Hakkımda">
                    About Me
                </h2>

                <!-- Hakkımda paragraflarının bulunduğu alan. -->
                <div class="about-content">

                    <!-- data.php içindeki aboutTexts dizisini döner. -->
                    <?php foreach ($aboutTexts as $paragraph): ?>

                        <!-- Her paragraf için İngilizce ve Türkçe metinleri basar. -->
                        <p data-en="<?= e($paragraph["en"]); ?>"
                           data-tr="<?= e($paragraph["tr"]); ?>">
                            <?= e($paragraph["en"]); ?>
                        </p>

                    <!-- foreach döngüsünü bitirir. -->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- TEKNOLOJİLER BÖLÜMÜ: Kullanılan teknolojileri ve becerileri gösterir. -->
        <section id="skills" class="skills section" aria-labelledby="skills-title">

            <!-- Teknoloji bölümünü ortalayan containerdır. -->
            <div class="container">

                <!-- Teknolojiler bölüm başlığıdır. -->
                <h2 id="skills-title" class="section-title" data-en="Tech Stack" data-tr="Teknolojiler">
                    Tech Stack
                </h2>

                <!-- Teknoloji kategorilerini kapsayan alan. -->
                <div class="tech-categories">

                    <!-- data.php içindeki teknoloji kategorilerini döner. -->
                    <?php foreach ($techCategories as $category): ?>

                        <!-- Her teknoloji kategorisi için kart oluşturur. -->
                        <article class="tech-category-card">

                            <!-- Kategori başlığını gösterir. -->
                            <h3 data-en="<?= e($category["title"]["en"]); ?>"
                                data-tr="<?= e($category["title"]["tr"]); ?>">
                                <?= e($category["title"]["en"]); ?>
                            </h3>

                            <!-- Teknoloji listesini başlatır. -->
                            <ul class="tech-list">

                                <!-- Kategori içindeki her teknolojiyi döner. -->
                                <?php foreach ($category["items"] as $item): ?>

                                    <!-- Her teknoloji için liste elemanı oluşturur. -->
                                    <li class="tech-item"
                                        data-tooltip="<?= e($item["tooltip"]["en"]); ?>"
                                        data-tooltip-en="<?= e($item["tooltip"]["en"]); ?>"
                                        data-tooltip-tr="<?= e($item["tooltip"]["tr"]); ?>">

                                        <!-- Teknoloji ikon alanıdır. -->
                                        <span class="tech-icon" aria-hidden="true">

                                            <!-- Eğer icon değeri varsa ikon sınıfını kullanır. -->
                                            <?php if (!empty($item["icon"])): ?>
                                                <i class="<?= e($item["icon"]); ?>"></i>

                                            <!-- Eğer icon yoksa yazı tabanlı ikon gösterir. -->
                                            <?php else: ?>
                                                <?= e($item["iconText"]); ?>

                                            <!-- if kontrolünü bitirir. -->
                                            <?php endif; ?>
                                        </span>

                                        <!-- Teknoloji adını gösterir. -->
                                        <span class="tech-name">
                                            <?= e($item["name"]); ?>
                                        </span>
                                    </li>

                                <!-- Teknoloji item döngüsünü bitirir. -->
                                <?php endforeach; ?>
                            </ul>
                        </article>

                    <!-- Teknoloji kategori döngüsünü bitirir. -->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- DENEYİM BÖLÜMÜ: İş, staj ve görev geçmişini gösterir. -->
        <section id="experience" class="experience section" aria-labelledby="experience-title">

            <!-- Deneyim bölümünü ortalayan containerdır. -->
            <div class="container">

                <!-- Deneyim bölüm başlığıdır. -->
                <h2 id="experience-title" class="section-title" data-en="Experience" data-tr="Deneyim">
                    Experience
                </h2>

                <!-- Tüm deneyim kartlarını kapsayan alan. -->
                <div class="experience-list">

                    <!-- data.php içindeki experiences dizisini döner. -->
                    <?php foreach ($experiences as $experience): ?>

                        <!-- Her deneyim için kart oluşturur. -->
                        <article class="experience-card">

                            <!-- Deneyim kartının üst kısmıdır. -->
                            <div class="experience-top">

                                <!-- Deneyimin kategorisini gösterir. -->
                                <span class="experience-category"
                                      data-en="<?= e($experience["category"]["en"]); ?>"
                                      data-tr="<?= e($experience["category"]["tr"]); ?>">
                                    <?= e($experience["category"]["en"]); ?>
                                </span>

                                <!-- Deneyim tarihini gösterir. -->
                                <span class="experience-date">
                                    <?= e($experience["date"]); ?>
                                </span>
                            </div>

                            <!-- Deneyim açıklama içeriği. -->
                            <div class="experience-content">

                                <!-- Deneyim başlığını gösterir. -->
                                <h3 data-en="<?= e($experience["title"]["en"]); ?>"
                                    data-tr="<?= e($experience["title"]["tr"]); ?>">
                                    <?= e($experience["title"]["en"]); ?>
                                </h3>

                                <!-- Şirket/kurum adını gösterir. -->
                                <p class="experience-company">
                                    <?= e($experience["company"]); ?>
                                </p>

                                <!-- Deneyim açıklamasını gösterir. -->
                                <p class="experience-description"
                                   data-en="<?= e($experience["description"]["en"]); ?>"
                                   data-tr="<?= e($experience["description"]["tr"]); ?>">
                                    <?= e($experience["description"]["en"]); ?>
                                </p>

                                <!-- Deneyime ait madde listesini başlatır. -->
                                <ul class="experience-points">

                                    <!-- Deneyim maddelerini döner. -->
                                    <?php foreach ($experience["items"] as $item): ?>

                                        <!-- Her deneyim maddesini liste elemanı olarak gösterir. -->
                                        <li data-en="<?= e($item["en"]); ?>"
                                            data-tr="<?= e($item["tr"]); ?>">
                                            <?= e($item["en"]); ?>
                                        </li>

                                    <!-- Deneyim maddeleri döngüsünü bitirir. -->
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </article>

                    <!-- Deneyimler döngüsünü bitirir. -->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- PROJELER BÖLÜMÜ: Portföy projelerini listeler. -->
        <section id="projects" class="projects section" aria-labelledby="projects-title">

            <!-- Projeler bölümünü ortalayan containerdır. -->
            <div class="container">

                <!-- Projeler bölüm başlığıdır. -->
                <h2 id="projects-title" class="section-title" data-en="Projects" data-tr="Projeler">
                    Projects
                </h2>

                <!-- Proje kartlarını grid yapısında gösteren alan. -->
                <div class="projects-grid">

                    <!-- data.php içindeki projects dizisini döner. -->
                    <?php foreach ($projects as $project): ?>

                        <!-- Her proje için kart oluşturur. -->
                        <article class="project-card">

                            <!-- Proje kartının üst kategori alanıdır. -->
                            <div class="project-card-top">

                                <!-- Proje kategorisini gösterir. -->
                                <span class="project-category"
                                      data-en="<?= e($project["category"]["en"]); ?>"
                                      data-tr="<?= e($project["category"]["tr"]); ?>">
                                    <?= e($project["category"]["en"]); ?>
                                </span>
                            </div>

                            <!-- Proje başlığını gösterir. -->
                            <h3><?= e($project["title"]); ?></h3>

                            <!-- Proje açıklamasını gösterir. -->
                            <p class="project-description"
                               data-en="<?= e($project["description"]["en"]); ?>"
                               data-tr="<?= e($project["description"]["tr"]); ?>">
                                <?= e($project["description"]["en"]); ?>
                            </p>

                            <!-- Projede kullanılan teknolojileri listeler. -->
                            <ul class="tech-stack" aria-label="Project technologies">

                                <!-- Proje teknolojilerini döner. -->
                                <?php foreach ($project["tech"] as $tech): ?>

                                    <!-- Her teknolojiyi liste elemanı olarak gösterir. -->
                                    <li class="tech"><?= e($tech); ?></li>

                                <!-- Teknoloji döngüsünü bitirir. -->
                                <?php endforeach; ?>
                            </ul>

                            <!-- Projenin GitHub reposuna yönlendiren linktir. -->
                            <a href="<?= e($project["github"]); ?>"
                               class="project-link"
                               target="_blank"
                               rel="noopener noreferrer"
                               data-en="View Repository →"
                               data-tr="Repoyu Gör →">
                                View Repository →
                            </a>
                        </article>

                    <!-- Projeler döngüsünü bitirir. -->
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- İLETİŞİM BÖLÜMÜ: İletişim bilgileri ve form alanını içerir. -->
        <section id="contact" class="contact section" aria-labelledby="contact-title">

            <!-- İletişim bölümünü ortalayan containerdır. -->
            <div class="container">

                <!-- İletişim bölüm başlığıdır. -->
                <h2 id="contact-title" class="section-title" data-en="Contact" data-tr="İletişim">
                    Contact
                </h2>

                <!-- İletişim bölümünün kısa açıklama metnidir. -->
                <p class="contact-intro"
                   data-en="<?= e($contactForm['intro']['en']); ?>"
                   data-tr="<?= e($contactForm['intro']['tr']); ?>">
                    <?= e($contactForm['intro']['en']); ?>
                </p>

                <!-- İletişim bilgileri ve formu yan yana tutan kapsayıcıdır. -->
                <div class="contact-wrapper">

                    <!-- Sol taraftaki iletişim bilgi kartıdır. -->
                    <aside class="contact-info-card" aria-label="Contact information">

                        <!-- İletişim bilgi maddelerini kapsar. -->
                        <div class="contact-info-list">

                            <!-- Mail adresine yönlendiren iletişim öğesi. -->
                            <a class="contact-info-item" href="mailto:<?= e($profile["email"]); ?>">

                                <!-- Mail ikon alanı. -->
                                <span class="contact-icon email-icon" aria-hidden="true">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>

                                <!-- Mail etiketi ve adresi. -->
                                <span>
                                    <!-- Mail alanı başlığını gösterir. -->
                                    <small data-en="<?= e($profile['contact_info']['email_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['email_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['email_label']['en']); ?>
                                    </small>

                                    <!-- Mail adresini kalın şekilde gösterir. -->
                                    <strong><?= e($profile["email"]); ?></strong>
                                </span>
                            </a>

                            <!-- GitHub profil linki. -->
                            <a class="contact-info-item"
                               href="<?= e($profile["github"]); ?>"
                               target="_blank"
                               rel="noopener noreferrer">

                                <!-- GitHub ikon alanı. -->
                                <span class="contact-icon github-icon" aria-hidden="true">
                                    <i class="fa-brands fa-github"></i>
                                </span>

                                <!-- GitHub yazı alanı. -->
                                <span>
                                    <!-- GitHub etiketini gösterir. -->
                                    <small data-en="<?= e($profile['contact_info']['github_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['github_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['github_label']['en']); ?>
                                    </small>

                                    <!-- GitHub aksiyon metnini gösterir. -->
                                    <strong data-en="<?= e($profile['contact_info']['github_action']['en']); ?>"
                                            data-tr="<?= e($profile['contact_info']['github_action']['tr']); ?>">
                                        <?= e($profile['contact_info']['github_action']['en']); ?>
                                    </strong>
                                </span>
                            </a>

                            <!-- LinkedIn profil linki. -->
                            <a class="contact-info-item"
                               href="<?= e($profile["linkedin"]); ?>"
                               target="_blank"
                               rel="noopener noreferrer">

                                <!-- LinkedIn ikon alanı. -->
                                <span class="contact-icon linkedin-icon" aria-hidden="true">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </span>

                                <!-- LinkedIn yazı alanı. -->
                                <span>
                                    <!-- LinkedIn etiketini gösterir. -->
                                    <small data-en="<?= e($profile['contact_info']['linkedin_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['linkedin_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['linkedin_label']['en']); ?>
                                    </small>

                                    <!-- LinkedIn aksiyon metnini gösterir. -->
                                    <strong data-en="<?= e($profile['contact_info']['linkedin_action']['en']); ?>"
                                            data-tr="<?= e($profile['contact_info']['linkedin_action']['tr']); ?>">
                                        <?= e($profile['contact_info']['linkedin_action']['en']); ?>
                                    </strong>
                                </span>
                            </a>
                        </div>
                    </aside>

                    <!-- İletişim formu. -->
                    <!-- action form gönderilince process-form.php dosyasına gider. -->
                    <!-- method="post" form verilerini güvenli şekilde gönderir. -->
                    <!-- novalidate tarayıcı varsayılan doğrulamasını kapatır. -->
                    <form class="contact-form" action="process-form.php" method="post" novalidate aria-describedby="form-help">

                        <!-- Form alanlarını mantıksal olarak gruplar. -->
                        <fieldset>

                            <!-- Formun ekran okuyucular için başlığıdır. -->
                            <legend class="sr-only">
                                <span data-en="Contact Form" data-tr="İletişim Formu">Contact Form</span>
                            </legend>

                            <!-- Form hakkında ekran okuyucu kullanıcılarına açıklama verir. -->
                            <p id="form-help" class="sr-only">
                                <span data-en="Fill in your details and message to get in touch"
                                      data-tr="Benimle iletişim kurmak için ayrıntılarınızı ve mesajınızı doldurun">
                                    Fill in your details and message to get in touch
                                </span>
                            </p>
                            
                            <!-- data.php içindeki form alanlarını döner. -->
                            <?php foreach ($contactForm['fields'] as $field): ?>

                                <!-- Her input/textarea için form grubu oluşturur. -->
                                <div class="form-group">

                                    <!-- Form alanının label etiketidir. -->
                                    <label for="<?= e($field['id']); ?>"
                                           data-en="<?= e($field['label']['en']); ?>"
                                           data-tr="<?= e($field['label']['tr']); ?>">
                                        <?= e($field['label']['en']); ?>

                                        <!-- Eğer alan zorunluysa yıldız işareti gösterir. -->
                                        <?php if ($field['required']): ?>
                                            <span aria-label="required" title="Required">*</span>
                                        <?php endif; ?>
                                    </label>

                                    <!-- Eğer alan tipi textarea ise çok satırlı mesaj kutusu oluşturur. -->
                                    <?php if ($field['type'] === 'textarea'): ?>

                                        <!-- Mesaj gibi uzun metin girişleri için textarea kullanılır. -->
                                        <textarea
                                            id="<?= e($field['id']); ?>"
                                            name="<?= e($field['name']); ?>"
                                            rows="<?= e($field['rows']); ?>"
                                            placeholder="<?= e($field['placeholder']['en']); ?>"
                                            data-placeholder-en="<?= e($field['placeholder']['en']); ?>"
                                            data-placeholder-tr="<?= e($field['placeholder']['tr']); ?>"
                                            <?= $field['required'] ? 'required aria-required="true"' : ''; ?>
                                            aria-label="<?= e($field['label']['en']); ?>"
                                        ></textarea>

                                    <!-- Eğer alan textarea değilse normal input oluşturur. -->
                                    <?php else: ?>

                                        <!-- İsim, e-posta gibi tek satırlık veri girişleri için input kullanılır. -->
                                        <input
                                            type="<?= e($field['type']); ?>"
                                            id="<?= e($field['id']); ?>"
                                            name="<?= e($field['name']); ?>"
                                            placeholder="<?= e($field['placeholder']['en']); ?>"
                                            data-placeholder-en="<?= e($field['placeholder']['en']); ?>"
                                            data-placeholder-tr="<?= e($field['placeholder']['tr']); ?>"
                                            <?= $field['required'] ? 'required aria-required="true"' : ''; ?>
                                            aria-label="<?= e($field['label']['en']); ?>"
                                        >

                                    <!-- textarea/input koşulunu bitirir. -->
                                    <?php endif; ?>
                                </div>

                            <!-- Form alanları döngüsünü bitirir. -->
                            <?php endforeach; ?>
                        </fieldset>

                        <!-- Form gönderme butonudur. -->
                        <button type="submit" class="btn contact-submit" aria-label="Submit contact form">

                            <!-- Buton yazısını data.php içinden çeker. -->
                            <span data-en="<?= e($contactForm['submit']['text']['en']); ?>"
                                  data-tr="<?= e($contactForm['submit']['text']['tr']); ?>">
                                <?= e($contactForm['submit']['text']['en']); ?>
                            </span>

                            <!-- Buton ikonunu data.php içinden çeker. -->
                            <i class="<?= e($contactForm['submit']['icon']); ?>" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer dosyasını sayfaya dahil eder. -->
    <?php include 'includes/footer.php'; ?>

    <!-- Sayfa içi JavaScript kodlarını başlatır. -->
    <script>
        /**
         * Dil Tercihi İşleyicisi
         * Kullanıcının daha önce seçtiği dili localStorage üzerinden okur.
         * Eğer kayıtlı dil varsa onu kullanır.
         * Eğer kayıtlı dil yoksa varsayılan olarak İngilizce kullanır.
         */
        (function() {
            // localStorage içinden daha önce kaydedilen dil tercihini alır.
            const savedLanguage = localStorage.getItem('portfolio-language');

            // Eğer kayıtlı dil varsa onu, yoksa 'en' değerini başlangıç dili olarak belirler.
            const initialLanguage = savedLanguage || 'en';
            
            // HTML etiketindeki lang değerini başlangıç diline göre günceller.
            document.documentElement.lang = initialLanguage;
            
            // Ana script.js dosyasının bu başlangıç dilini kullanabilmesi için window içine kaydeder.
            window.__initialLanguage = initialLanguage;
        })();
    </script>
    
    <!-- Ana JavaScript dosyasını sayfaya bağlar. -->
    <script src="js/script.js"></script>
</body>
</html>