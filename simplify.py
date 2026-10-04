import re

css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"
js_path = "c:/Users/Asus/aysenur-portfolio/js/script.js"
template_path = "c:/Users/Asus/aysenur-portfolio/src/template.html"
components_dir = "c:/Users/Asus/aysenur-portfolio/src/components/"
import os

# 1. Simplify CSS (Remove heavy animations, blobs, and directional reveals)
with open(css_path, "r", encoding="utf-8") as f:
    css = f.read()

# Remove trail, magnetic btn, typing cursor, float animations, and complex background blobs
css = re.sub(r'/\* Floating Orbs \(Blobs\).*?@keyframes float.*?}', '', css, flags=re.DOTALL)
css = re.sub(r'\.cursor-trail.*?mix-blend-mode: screen;\s*}', '', css, flags=re.DOTALL)
css = re.sub(r'\.magnetic-btn.*?}', '', css, flags=re.DOTALL)
css = re.sub(r'\.typing-cursor.*?@keyframes blink.*?}', '', css, flags=re.DOTALL)
css = re.sub(r'\.glass-id-card\s*\{.*?@keyframes floatingCard.*?\}', '', css, flags=re.DOTALL)
css = re.sub(r'/\* Floating Orbs \(Blobs\).*?@keyframes float.*?}', '', css, flags=re.DOTALL)

# Simplify reveals to just a soft fade-in
css = re.sub(r'\.reveal-left.*?\.reveal-up\.active.*?}', 
"""
/* Simple, elegant fade-in reveal */
.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-up {
    opacity: 0;
    transform: translateY(15px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}
.reveal.active, .reveal-left.active, .reveal-right.active, .reveal-zoom.active, .reveal-up.active {
    opacity: 1;
    transform: translateY(0);
}
""", css, flags=re.DOTALL)

with open(css_path, "w", encoding="utf-8") as f:
    f.write(css)

# 2. Simplify JS (Remove magic cursor, 3D tilt, magnetic buttons, typewriter)
with open(js_path, "r", encoding="utf-8") as f:
    js = f.read()

# Remove the block inside script.js that handles these
js = re.sub(r'// 1\. Trailing Glow Cursor.*?// 2\. Magnetic Buttons.*?}\);', '', js, flags=re.DOTALL)
js = re.sub(r'// 3D Tilt Effect for Cards.*?// Typewriter effect for Tagline.*?}\);', '', js, flags=re.DOTALL)
js = re.sub(r'// Typewriter effect for Tagline.*?\}\);', '', js, flags=re.DOTALL)

# Fix up the JS to ensure no syntax errors (we might have ripped out too much or too little)
# Let's just recreate a clean version of the event listener for those features since it's messy to regex.
# Actually, the spotlight effect is still desired? The user said "Daha sade". 
# Spotlight is okay, but 3D tilt is too much. 

# Let's just safely read the lines and exclude the unwanted blocks.
lines = js.split('\n')
clean_js = []
skip = False
for line in lines:
    if "// 1. Trailing Glow Cursor" in line or "// 3D Tilt Effect for Cards" in line or "// Typewriter effect" in line or "// 2. Magnetic Buttons" in line:
        skip = True
    
    if skip and ("});" in line or "});" in line):
        # We need to be careful not to skip the main DOMContentLoaded closing bracket
        pass

# A safer approach for JS: just overwrite script.js with the base logic + spotlight, minus the noise.
# Since we know exactly what is in script.js (Theme, Lang, Reveal, Spotlight)

new_js = """
document.addEventListener('DOMContentLoaded', () => {
    // Reveal Effect
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-up, section');
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

    revealElements.forEach(el => revealObserver.observe(el));

    // Spotlight Effect for Cards (Kept for premium feel)
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
# Assuming the theme/language switching logic is in another file or earlier in script.js.
# Actually, script.js handles theme and lang. Let's just use Python to surgically remove the bad code blocks.
