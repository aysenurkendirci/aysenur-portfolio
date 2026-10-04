import re
import os

components_dir = "c:/Users/Asus/aysenur-portfolio/src/components/"
template_path = "c:/Users/Asus/aysenur-portfolio/src/template.html"
css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"

# 1. CSS Layout Safety (Prevent Kaymalar)
css_append = """
/* === LAYOUT SAFETY & OVERFLOW PREVENTION === */
html, body {
    max-width: 100vw;
    overflow-x: hidden; /* Prevent horizontal scrolling/shifting */
}

* {
    box-sizing: border-box;
}

img, video, canvas, svg {
    max-width: 100%;
    height: auto;
}

p, h1, h2, h3, h4, h5, h6, a, span {
    word-wrap: break-word;
    overflow-wrap: break-word;
}
"""
with open(css_path, "a", encoding="utf-8") as f:
    f.write(css_append)


# 2. Template Security (CSP & Meta tags)
with open(template_path, "r", encoding="utf-8") as f:
    template_content = f.read()

security_meta = """
    <!-- Security & Validation Meta Tags -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' https: 'unsafe-inline' 'unsafe-eval'; img-src 'self' data: https:; font-src 'self' https: data:; connect-src 'self' https:;">
"""

if "X-Content-Type-Options" not in template_content:
    template_content = template_content.replace("<head>", "<head>\n" + security_meta)
    with open(template_path, "w", encoding="utf-8") as f:
        f.write(template_content)

# 3. HTML Security (noopener noreferrer on all target="_blank")
for filename in os.listdir(components_dir):
    if filename.endswith(".html"):
        filepath = os.path.join(components_dir, filename)
        with open(filepath, "r", encoding="utf-8") as f:
            content = f.read()
        
        # Add rel="noopener noreferrer" if target="_blank" exists and rel doesn't exist
        # A simpler way is to just ensure any target="_blank" has it.
        # But wait, we might have multiple a tags. Let's use a regex replace.
        content = re.sub(r'(<a[^>]*target="_blank"[^>]*)>', 
                         lambda m: m.group(1) + ' rel="noopener noreferrer">' if 'rel=' not in m.group(1) else m.group(0), 
                         content)
                         
        with open(filepath, "w", encoding="utf-8") as f:
            f.write(content)

print("Security and layout protections applied!")
