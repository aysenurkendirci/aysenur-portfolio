import re

css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"

# Add section specific backgrounds
css_append = """
/* Section Specific Backgrounds for Depth */
.skills.section {
    position: relative;
    background: radial-gradient(circle at center, rgba(147, 51, 234, 0.04) 0%, transparent 70%);
    border-top: 1px solid rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid rgba(255, 255, 255, 0.02);
}

.experience.section {
    position: relative;
    background: radial-gradient(ellipse at top right, rgba(45, 212, 191, 0.04) 0%, transparent 60%);
}

.projects.section {
    position: relative;
    background: radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.04) 0%, transparent 70%);
    border-top: 1px solid rgba(255, 255, 255, 0.02);
    border-bottom: 1px solid rgba(255, 255, 255, 0.02);
}

.contact.section {
    position: relative;
    background: radial-gradient(circle at top, rgba(236, 72, 153, 0.04) 0%, transparent 60%);
}

/* Subtle glowing noise overlay for all sections to make them feel connected yet different */
.section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    pointer-events: none;
    z-index: -1;
}
"""

with open(css_path, "a", encoding="utf-8") as f:
    f.write(css_append)

print("Section backgrounds added!")
