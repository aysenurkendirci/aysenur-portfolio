import re

# 1. Clean script.js
js_path = "c:/Users/Asus/aysenur-portfolio/js/script.js"
with open(js_path, "r", encoding="utf-8") as f:
    js = f.read()

# Truncate script.js right before the 3D Tilt Effect block starts
split_point = js.find("document.addEventListener('DOMContentLoaded', () => {\n    // 3D Tilt Effect for Cards")
if split_point != -1:
    js = js[:split_point]
    
with open(js_path, "w", encoding="utf-8") as f:
    f.write(js)

# 2. Clean base.css
css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"
with open(css_path, "r", encoding="utf-8") as f:
    css = f.read()

# Remove specific CSS classes
classes_to_remove = [
    r'/\* Floating Orbs \(Blobs\).*?@keyframes float.*?}',
    r'\.cursor-trail\s*\{.*?mix-blend-mode: screen;\s*}',
    r'\.magnetic-btn\s*\{.*?\}',
    r'\.typing-cursor::after\s*\{.*?@keyframes blink.*?}',
    r'\.glass-id-card\s*\{.*?@keyframes floatingCard.*?\}',
]

for regex in classes_to_remove:
    css = re.sub(regex, '', css, flags=re.DOTALL)

# Simplify reveals
css = re.sub(r'\.reveal-left, \.reveal-right.*?\.reveal-up\.active\s*\{.*?\}', 
"""/* SADECE BASİT FADE-IN REVEAL */
.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.reveal.active, .reveal-left.active, .reveal-right.active, .reveal-zoom.active, .reveal-up.active {
    opacity: 1;
    transform: translateY(0);
}
""", css, flags=re.DOTALL)

with open(css_path, "w", encoding="utf-8") as f:
    f.write(css)

print("Simplified successfully!")
