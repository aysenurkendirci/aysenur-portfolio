import re

css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"
hero_css_path = "c:/Users/Asus/aysenur-portfolio/css/hero.css"
js_path = "c:/Users/Asus/aysenur-portfolio/js/script.js"

# 1. Update CSS
css_append = """
/* Trailing Glowing Cursor */
.cursor-trail {
    position: fixed;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(45, 212, 191, 0.4);
    box-shadow: 0 0 20px rgba(45, 212, 191, 0.8), 0 0 40px rgba(147, 51, 234, 0.6);
    pointer-events: none;
    z-index: 9999;
    transform: translate(-50%, -50%);
    transition: width 0.2s, height 0.2s;
    mix-blend-mode: screen;
}

/* Float Animation for Hero Image / Card */
.glass-id-card {
    animation: floatingCard 6s ease-in-out infinite;
}
@keyframes floatingCard {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(2deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

/* Magnetic Button Hover State */
.magnetic-btn {
    transition: transform 0.1s cubic-bezier(0.25, 1, 0.5, 1);
}
"""
with open(css_path, "a", encoding="utf-8") as f:
    f.write(css_append)


# 2. Update JS for Magic Trailing Cursor and Magnetic Buttons
js_append = """
document.addEventListener('DOMContentLoaded', () => {
    // 1. Trailing Glow Cursor
    const trail = document.createElement('div');
    trail.className = 'cursor-trail';
    document.body.appendChild(trail);
    
    let mouseX = 0, mouseY = 0;
    let trailX = 0, trailY = 0;
    
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });
    
    function animateTrail() {
        // Smoothly interpolate trail position towards actual mouse position
        trailX += (mouseX - trailX) * 0.15;
        trailY += (mouseY - trailY) * 0.15;
        trail.style.left = `${trailX}px`;
        trail.style.top = `${trailY}px`;
        requestAnimationFrame(animateTrail);
    }
    animateTrail();
    
    // Enlarge trail on clickable elements
    const clickables = document.querySelectorAll('a, button, .premium-project-card, .experience-card-brittany');
    clickables.forEach(el => {
        el.addEventListener('mouseenter', () => {
            trail.style.width = '50px';
            trail.style.height = '50px';
            trail.style.background = 'rgba(147, 51, 234, 0.3)'; // Switch to purple
        });
        el.addEventListener('mouseleave', () => {
            trail.style.width = '20px';
            trail.style.height = '20px';
            trail.style.background = 'rgba(45, 212, 191, 0.4)'; // Back to teal
        });
    });

    // 2. Magnetic Buttons
    const magneticBtns = document.querySelectorAll('.btn-primary, .btn-outline');
    magneticBtns.forEach(btn => {
        btn.classList.add('magnetic-btn');
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            // Move button slightly towards cursor
            btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0px, 0px)';
        });
    });
});
"""

with open(js_path, "a", encoding="utf-8") as f:
    f.write(js_append)

print("More beauties added without committing!")
