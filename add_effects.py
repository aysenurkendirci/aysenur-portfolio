import re

# 1. Add CSS for reveal effects and animated background
css_append = """
/* Scroll Reveal Animations */
.reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s cubic-bezier(0.5, 0, 0, 1), transform 0.8s cubic-bezier(0.5, 0, 0, 1);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

/* Staggered card reveals */
.projects-grid .project-card, .experience-list .experience-card-brittany {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.reveal.active .project-card, .reveal.active .experience-card-brittany {
    opacity: 1;
    transform: translateY(0);
}

.reveal.active .project-card:nth-child(1) { transition-delay: 0.1s; }
.reveal.active .project-card:nth-child(2) { transition-delay: 0.2s; }
.reveal.active .project-card:nth-child(3) { transition-delay: 0.3s; }
.reveal.active .project-card:nth-child(4) { transition-delay: 0.4s; }

.reveal.active .experience-card-brittany:nth-child(1) { transition-delay: 0.1s; }
.reveal.active .experience-card-brittany:nth-child(2) { transition-delay: 0.2s; }
.reveal.active .experience-card-brittany:nth-child(3) { transition-delay: 0.3s; }

/* Subtle Animated Background for Dark Theme */
body.dark-theme {
    background: linear-gradient(135deg, #020c1b 0%, #0a192f 50%, #112240 100%);
    background-size: 200% 200%;
    animation: bgGradientMove 15s ease infinite;
}

@keyframes bgGradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
"""

with open("c:/Users/Asus/aysenur-portfolio/css/base.css", "a", encoding="utf-8") as f:
    f.write(css_append)


# 2. Add Intersection Observer logic to script.js
js_append = """
document.addEventListener('DOMContentLoaded', () => {
    // Scroll Reveal Effect
    const revealElements = document.querySelectorAll('section, .reveal-target');
    
    // Add reveal class to all sections by default if not present
    revealElements.forEach(el => {
        if(!el.classList.contains('reveal')) {
            el.classList.add('reveal');
        }
    });

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                // Optional: Stop observing once revealed
                // observer.unobserve(entry.target); 
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    });

    revealElements.forEach(el => revealObserver.observe(el));
});
"""

with open("c:/Users/Asus/aysenur-portfolio/js/script.js", "a", encoding="utf-8") as f:
    f.write(js_append)

print("Effects added!")
