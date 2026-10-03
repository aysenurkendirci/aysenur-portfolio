import re
import os

files_to_update = [
    "c:/Users/Asus/aysenur-portfolio/src/template.html",
    "c:/Users/Asus/aysenur-portfolio/build.js"
]

for file_path in files_to_update:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()
    
    # Replace v=1.0 or v=1.1 or whatever with v=2.0 to bust cache completely
    content = re.sub(r'css/base\.css\?v=[\d\.]+', 'css/base.css?v=2.0', content)
    content = re.sub(r'css/navbar\.css\?v=[\d\.]+', 'css/navbar.css?v=2.0', content)
    content = re.sub(r'css/hero\.css\?v=[\d\.]+', 'css/hero.css?v=2.0', content)
    content = re.sub(r'css/content\.css\?v=[\d\.]+', 'css/content.css?v=2.0', content)
    
    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content)

print("Cache busting versions updated to v=2.0")
