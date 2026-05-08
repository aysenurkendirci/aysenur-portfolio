<?php
include 'data.php';

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayşe Nur Kendirci | Personal Portfolio</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <?php include 'includes/navbar.php'; ?>

    <main>
        <section id="home" class="hero hero-split" aria-labelledby="hero-title">
            <div class="hero-bg-word" aria-hidden="true">PORTFOLIO</div>

            <div class="container hero-split-layout">
                <div class="hero-left">
                    <p class="intro-line" data-en="Hello, I'm" data-tr="Merhaba, ben">
                        Hello, I'm
                    </p>

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
                        <a href="<?= e($profile["github"]); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub profile">
                            <i class="devicon-github-original" aria-hidden="true"></i>
                        </a>

                        <a href="<?= e($profile["linkedin"]); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile">
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
                                <img src="<?= e($profile["image"]); ?>" alt="Portrait of <?= e($profile["name"]); ?>">
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

        <section id="skills" class="skills section" aria-labelledby="skills-title">
            <div class="container">
                <h2 id="skills-title" class="section-title" data-en="Tech Stack" data-tr="Teknolojiler">
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
                                    <li class="tech-item"
                                        data-tooltip="<?= e($item["tooltip"]["en"]); ?>"
                                        data-tooltip-en="<?= e($item["tooltip"]["en"]); ?>"
                                        data-tooltip-tr="<?= e($item["tooltip"]["tr"]); ?>">
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

        <section id="experience" class="experience section" aria-labelledby="experience-title">
            <div class="container">
                <h2 id="experience-title" class="section-title" data-en="Experience" data-tr="Deneyim">
                    Experience
                </h2>

                <div class="experience-list">
                    <?php foreach ($experiences as $experience): ?>
                        <article class="experience-card">
                            <div class="experience-top">
                                <span class="experience-category"
                                      data-en="<?= e($experience["category"]["en"]); ?>"
                                      data-tr="<?= e($experience["category"]["tr"]); ?>">
                                    <?= e($experience["category"]["en"]); ?>
                                </span>

                                <span class="experience-date">
                                    <?= e($experience["date"]); ?>
                                </span>
                            </div>

                            <div class="experience-content">
                                <h3 data-en="<?= e($experience["title"]["en"]); ?>"
                                    data-tr="<?= e($experience["title"]["tr"]); ?>">
                                    <?= e($experience["title"]["en"]); ?>
                                </h3>

                                <p class="experience-company">
                                    <?= e($experience["company"]); ?>
                                </p>

                                <p class="experience-description"
                                   data-en="<?= e($experience["description"]["en"]); ?>"
                                   data-tr="<?= e($experience["description"]["tr"]); ?>">
                                    <?= e($experience["description"]["en"]); ?>
                                </p>

                                <ul class="experience-points">
                                    <?php foreach ($experience["items"] as $item): ?>
                                        <li data-en="<?= e($item["en"]); ?>"
                                            data-tr="<?= e($item["tr"]); ?>">
                                            <?= e($item["en"]); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="projects" class="projects section" aria-labelledby="projects-title">
            <div class="container">
                <h2 id="projects-title" class="section-title" data-en="Projects" data-tr="Projeler">
                    Projects
                </h2>

                <div class="projects-grid">
                    <?php foreach ($projects as $project): ?>
                        <article class="project-card">
                            <div class="project-card-top">
                                <span class="project-category"
                                      data-en="<?= e($project["category"]["en"]); ?>"
                                      data-tr="<?= e($project["category"]["tr"]); ?>">
                                    <?= e($project["category"]["en"]); ?>
                                </span>
                            </div>

                            <h3><?= e($project["title"]); ?></h3>

                            <p class="project-description"
                               data-en="<?= e($project["description"]["en"]); ?>"
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
                               data-en="View Repository →"
                               data-tr="Repoyu Gör →">
                                View Repository →
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="contact" class="contact section" aria-labelledby="contact-title">
            <div class="container">
                <h2 id="contact-title" class="section-title" data-en="Contact" data-tr="İletişim">
                    Contact
                </h2>

                <p class="contact-intro"
                   data-en="<?= e($contactForm['intro']['en']); ?>"
                   data-tr="<?= e($contactForm['intro']['tr']); ?>">
                    <?= e($contactForm['intro']['en']); ?>
                </p>

                <div class="contact-wrapper">
                    <aside class="contact-info-card" aria-label="Contact information">
                        <div class="contact-info-list">
                            <a class="contact-info-item" href="mailto:<?= e($profile["email"]); ?>">
                                <span class="contact-icon email-icon" aria-hidden="true">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>

                                <span>
                                    <small data-en="<?= e($profile['contact_info']['email_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['email_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['email_label']['en']); ?>
                                    </small>
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
                                    <small data-en="<?= e($profile['contact_info']['github_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['github_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['github_label']['en']); ?>
                                    </small>
                                    <strong data-en="<?= e($profile['contact_info']['github_action']['en']); ?>"
                                            data-tr="<?= e($profile['contact_info']['github_action']['tr']); ?>">
                                        <?= e($profile['contact_info']['github_action']['en']); ?>
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
                                    <small data-en="<?= e($profile['contact_info']['linkedin_label']['en']); ?>"
                                           data-tr="<?= e($profile['contact_info']['linkedin_label']['tr']); ?>">
                                        <?= e($profile['contact_info']['linkedin_label']['en']); ?>
                                    </small>
                                    <strong data-en="<?= e($profile['contact_info']['linkedin_action']['en']); ?>"
                                            data-tr="<?= e($profile['contact_info']['linkedin_action']['tr']); ?>">
                                        <?= e($profile['contact_info']['linkedin_action']['en']); ?>
                                    </strong>
                                </span>
                            </a>
                        </div>
                    </aside>

                    <form class="contact-form" action="process-form.php" method="post">
                        <?php foreach ($contactForm['fields'] as $field): ?>
                            <div class="form-group">
                                <label for="<?= e($field['id']); ?>"
                                       data-en="<?= e($field['label']['en']); ?>"
                                       data-tr="<?= e($field['label']['tr']); ?>">
                                    <?= e($field['label']['en']); ?>
                                </label>
                                <?php if ($field['type'] === 'textarea'): ?>
                                    <textarea
                                        id="<?= e($field['id']); ?>"
                                        name="<?= e($field['name']); ?>"
                                        rows="<?= e($field['rows']); ?>"
                                        placeholder="<?= e($field['placeholder']['en']); ?>"
                                        data-placeholder-en="<?= e($field['placeholder']['en']); ?>"
                                        data-placeholder-tr="<?= e($field['placeholder']['tr']); ?>"
                                        <?= $field['required'] ? 'required' : ''; ?>
                                    ></textarea>
                                <?php else: ?>
                                    <input
                                        type="<?= e($field['type']); ?>"
                                        id="<?= e($field['id']); ?>"
                                        name="<?= e($field['name']); ?>"
                                        placeholder="<?= e($field['placeholder']['en']); ?>"
                                        data-placeholder-en="<?= e($field['placeholder']['en']); ?>"
                                        data-placeholder-tr="<?= e($field['placeholder']['tr']); ?>"
                                        <?= $field['required'] ? 'required' : ''; ?>
                                    >
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <button type="submit" class="btn contact-submit">
                            <span data-en="<?= e($contactForm['submit']['text']['en']); ?>"
                                  data-tr="<?= e($contactForm['submit']['text']['tr']); ?>">
                                <?= e($contactForm['submit']['text']['en']); ?>
                            </span>
                            <i class="<?= e($contactForm['submit']['icon']); ?>" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>