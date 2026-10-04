import re
import os

components_dir = "c:/Users/Asus/aysenur-portfolio/src/components/"
template_path = "c:/Users/Asus/aysenur-portfolio/src/template.html"
css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"
js_path = "c:/Users/Asus/aysenur-portfolio/js/script.js"

# 1. Update components with new reveal classes
def add_class(filename, tag, new_class):
    path = os.path.join(components_dir, filename)
    with open(path, "r", encoding="utf-8") as f:
        content = f.read()
    
    # regex to find class="..." and append new_class
    content = re.sub(r'(<section[^>]*class=")([^"]*)(")', r'\1\2 ' + new_class + r'\3', content, count=1)
    
    with open(path, "w", encoding="utf-8") as f:
        f.write(content)

add_class("about.html", "about", "reveal-left")
add_class("skills.html", "skills", "reveal-right")
add_class("experience.html", "experience", "reveal-zoom")
add_class("projects.html", "projects", "reveal-zoom")
add_class("contact.html", "contact", "reveal-up")

# 2. Add floating blobs to template.html
with open(template_path, "r", encoding="utf-8") as f:
    template_content = f.read()

blobs_html = """
    <!-- Floating Background Orbs for Premium UI -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    
    {{NAVBAR}}
"""
if '<div class="blob blob-1"></div>' not in template_content:
    template_content = template_content.replace('{{NAVBAR}}', blobs_html)
    with open(template_path, "w", encoding="utf-8") as f:
        f.write(template_content)

# 3. Add CSS for new animations and blobs
css_append = """
/* Floating Orbs (Blobs) */
.blob {
    position: fixed;
    border-radius: 50%;
    filter: blur(100px);
    z-index: -1;
    opacity: 0.5;
    pointer-events: none;
    animation: float 20s infinite alternate ease-in-out;
}
.blob-1 {
    top: -10%;
    right: -5%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(45,212,191,0.15) 0%, rgba(45,212,191,0) 70%);
}
.blob-2 {
    bottom: -20%;
    left: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(14,165,233,0.15) 0%, rgba(14,165,233,0) 70%);
    animation-delay: -5s;
}

@keyframes float {
    0% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(-50px, 30px) scale(1.1); }
    66% { transform: translate(30px, -50px) scale(0.9); }
    100% { transform: translate(0, 0) scale(1); }
}

/* Directional Reveal Animations */
.reveal-left, .reveal-right, .reveal-zoom, .reveal-up {
    opacity: 0;
    transition: all 1s cubic-bezier(0.5, 0, 0, 1);
}

.reveal-left { transform: translateX(-50px); }
.reveal-right { transform: translateX(50px); }
.reveal-zoom { transform: scale(0.9); }
.reveal-up { transform: translateY(50px); }

.reveal-left.active, .reveal-right.active, .reveal-zoom.active, .reveal-up.active {
    opacity: 1;
    transform: translateX(0) scale(1) translateY(0);
}
"""
with open(css_path, "r", encoding="utf-8") as f:
    css_content = f.read()
if ".reveal-left" not in css_content:
    with open(css_path, "a", encoding="utf-8") as f:
        f.write(css_append)

# 4. Update JS to track all these classes
with open(js_path, "r", encoding="utf-8") as f:
    js_content = f.read()

# Replace the selector in JS to include new reveal classes
js_content = js_content.replace(
    "const revealElements = document.querySelectorAll('section, .reveal-target');",
    "const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-up, .reveal-target');"
)
# Ensure the new classes get picked up if added dynamically (though they are hardcoded in HTML now)

with open(js_path, "w", encoding="utf-8") as f:
    f.write(js_content)

print("Decorations and animations added successfully!")
