import re
import os

navbar_css_path = "c:/Users/Asus/aysenur-portfolio/css/navbar.css"
base_css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"

# 1. Add Navbar Underline Animation
navbar_css_append = """
/* Navbar Link Hover Underline Animation */
.nav-links a {
    position: relative;
    padding-bottom: 4px;
}
.nav-links a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: var(--primary-accent-color);
    transition: width 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: 0 0 10px rgba(45, 212, 191, 0.5);
}
.nav-links a:hover::after,
.nav-links a.active::after {
    width: 100%;
}
"""
with open(navbar_css_path, "a", encoding="utf-8") as f:
    f.write(navbar_css_append)


# 2. Add Button Shine & Tech Badge pops to base.css
base_css_append = """
/* Button Shine Sweep Effect */
.btn-primary, .btn-outline {
    position: relative;
    overflow: hidden;
}
.btn-primary::after, .btn-outline::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -60%;
    width: 20%;
    height: 200%;
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(30deg);
    transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1);
}
.btn-primary:hover::after, .btn-outline:hover::after {
    left: 120%;
}

/* Subtle pulse on primary button to attract attention */
.btn-primary {
    animation: gentlePulse 3s infinite;
}
@keyframes gentlePulse {
    0% { box-shadow: 0 0 0 0 rgba(45, 212, 191, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(45, 212, 191, 0); }
    100% { box-shadow: 0 0 0 0 rgba(45, 212, 191, 0); }
}

/* Tech Badge Staggered Pop on Card Hover */
.premium-tech-badge {
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
}
.premium-project-card:hover .premium-tech-badge,
.experience-card-brittany:hover .premium-tech-badge {
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(45, 212, 191, 0.2);
}
/* Staggering the tech badge pops */
.premium-project-card:hover .premium-tech-badge:nth-child(1), .experience-card-brittany:hover .premium-tech-badge:nth-child(1) { transition-delay: 0.05s; }
.premium-project-card:hover .premium-tech-badge:nth-child(2), .experience-card-brittany:hover .premium-tech-badge:nth-child(2) { transition-delay: 0.1s; }
.premium-project-card:hover .premium-tech-badge:nth-child(3), .experience-card-brittany:hover .premium-tech-badge:nth-child(3) { transition-delay: 0.15s; }
.premium-project-card:hover .premium-tech-badge:nth-child(4), .experience-card-brittany:hover .premium-tech-badge:nth-child(4) { transition-delay: 0.2s; }
.premium-project-card:hover .premium-tech-badge:nth-child(5), .experience-card-brittany:hover .premium-tech-badge:nth-child(5) { transition-delay: 0.25s; }

/* Social Icons bouncy hover */
.social-links a {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), color 0.3s;
}
.social-links a:hover {
    transform: scale(1.2) translateY(-3px);
    color: var(--primary-accent-color);
}
"""
with open(base_css_path, "a", encoding="utf-8") as f:
    f.write(base_css_append)

print("Micro-animations added!")
