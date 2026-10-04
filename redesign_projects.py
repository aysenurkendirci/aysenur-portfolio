import re

# 1. Rewrite projects.html
projects_html = """<section id="projects" class="projects section" aria-labelledby="projects-title">
    <div class="container">
        <h2 id="projects-title" class="section-title" data-en="Projects" data-tr="Projeler">
            Projects
        </h2>
        <div class="projects-grid">
            {{#each projects}}
            <article class="project-card premium-project-card">
                <div class="project-header">
                    <div class="project-top-row">
                        <span class="project-category"
                              data-en="{{category.en}}"
                              data-tr="{{category.tr}}">
                            {{category.en}}
                        </span>
                        <a href="{{github}}"
                           class="project-github-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="GitHub Repository">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                    <h3 class="project-title">{{title}}</h3>
                </div>
                <div class="project-body">
                    <p class="project-description"
                       data-en="{{description.en}}"
                       data-tr="{{description.tr}}">
                        {{description.en}}
                    </p>
                </div>
                <ul class="tech-stack premium-tech-stack" aria-label="Project technologies">
                    {{#each tech}}
                    <li class="premium-tech-badge">{{this}}</li>
                    {{/each}}
                </ul>
            </article>
            {{/each}}
        </div>
    </div>
</section>
"""

with open("c:/Users/Asus/aysenur-portfolio/src/components/projects.html", "w", encoding="utf-8") as f:
    f.write(projects_html)

# 2. Append premium CSS to content.css
css_append = """
/* Premium Project Card Overrides */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.premium-project-card {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 30px;
    border-radius: 16px;
    background: rgba(30, 41, 59, 0.2) !important;
    border: 1px solid rgba(255, 255, 255, 0.05) !important;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(5px);
    overflow: hidden;
    min-height: 320px;
}

.premium-project-card:hover {
    transform: translateY(-5px) !important;
    background: rgba(30, 41, 59, 0.6) !important;
    border-color: rgba(45, 212, 191, 0.2) !important;
    box-shadow: 0 10px 30px -10px rgba(2, 12, 27, 0.7) !important;
}

.project-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.project-github-link {
    color: var(--secondary-text-color);
    font-size: 22px;
    transition: color 0.3s ease;
}

.project-github-link:hover {
    color: var(--primary-accent-color);
}

.premium-project-card .project-title {
    font-size: 22px !important;
    font-weight: 700;
    margin-bottom: 16px !important;
    color: var(--primary-text-color) !important;
    transition: color 0.3s ease;
}

.premium-project-card:hover .project-title {
    color: var(--primary-accent-color) !important;
}

.premium-project-card .project-description {
    color: var(--secondary-text-color) !important;
    font-size: 14.5px !important;
    line-height: 1.6 !important;
    margin-bottom: 24px !important;
}

.premium-tech-stack {
    display: flex;
    flex-wrap: wrap;
    gap: 8px !important;
    margin-top: auto !important; /* pushes tech stack to bottom */
    padding: 0 !important;
    list-style: none !important;
}

.premium-tech-badge {
    padding: 5px 12px;
    border-radius: 999px;
    background: rgba(45, 212, 191, 0.1);
    color: #2dd4bf;
    font-size: 12.5px;
    font-weight: 600;
    letter-spacing: 0.5px;
}
"""

with open("c:/Users/Asus/aysenur-portfolio/css/content.css", "a", encoding="utf-8") as f:
    f.write(css_append)

print("Redesigned projects section applied!")
