import re
import os

css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"
content_css_path = "c:/Users/Asus/aysenur-portfolio/css/content.css"
hero_css_path = "c:/Users/Asus/aysenur-portfolio/css/hero.css"
js_path = "c:/Users/Asus/aysenur-portfolio/js/script.js"

# 1. Update Hero Title with Animated Gradient
hero_css_append = """
/* Animated Gradient Text for Name */
.hero-title {
    background: linear-gradient(
        to right,
        var(--primary-accent-color),
        #9333ea,
        var(--primary-accent-color)
    );
    background-size: 200% auto;
    color: transparent;
    -webkit-background-clip: text;
    background-clip: text;
    animation: shine 4s linear infinite;
    font-weight: 900;
}

@keyframes shine {
    to {
        background-position: 200% center;
    }
}
"""
with open(hero_css_path, "a", encoding="utf-8") as f:
    f.write(hero_css_append)

# 2. Add Spotlight Effect CSS to content.css
content_css_append = """
/* Spotlight Card Hover Effect */
.premium-project-card, .experience-card-brittany {
    position: relative;
}

.premium-project-card::after, .experience-card-brittany::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    opacity: 0;
    transition: opacity 0.3s;
    background: radial-gradient(
        600px circle at var(--mouse-x) var(--mouse-y), 
        rgba(45, 212, 191, 0.1),
        transparent 40%
    );
    z-index: 3;
    pointer-events: none;
}

.premium-project-card:hover::after, .experience-card-brittany:hover::after {
    opacity: 1;
}

/* Enhanced Skill Icons */
.tech-item {
    transition: all 0.3s ease;
}
.tech-item:hover {
    transform: translateY(-5px) scale(1.05);
    background: rgba(45, 212, 191, 0.05);
    border-color: rgba(45, 212, 191, 0.3);
    box-shadow: 0 10px 20px -10px rgba(45, 212, 191, 0.3);
}
.tech-item i {
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.tech-item:hover i {
    transform: scale(1.2) rotate(5deg);
}
"""
with open(content_css_path, "a", encoding="utf-8") as f:
    f.write(content_css_append)


# 3. Add Spotlight JS to script.js
js_append = """
document.addEventListener('DOMContentLoaded', () => {
    // Spotlight Effect for Cards
    const cards = document.querySelectorAll('.premium-project-card, .experience-card-brittany');
    
    cards.forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
});
"""
with open(js_path, "a", encoding="utf-8") as f:
    f.write(js_append)

print("Wow factor effects added!")
