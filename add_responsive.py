import re

css_path = "c:/Users/Asus/aysenur-portfolio/css/base.css"

# Add Comprehensive Responsive Media Queries
responsive_css = """
/* ==========================================================================
   RESPONSIVE DESIGN (MOBİL VE TÜM EKRAN UYUMLULUKLARI)
   ========================================================================== */

/* Tablets & Smaller Laptops (max-width: 1024px) */
@media screen and (max-width: 1024px) {
    .container {
        padding: 0 40px;
    }
    .hero-content {
        flex-direction: column;
        text-align: center;
        gap: 3rem;
        padding-top: 120px;
    }
    .hero-text {
        max-width: 100%;
        align-items: center;
    }
    .hero-buttons {
        justify-content: center;
    }
    .projects-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on tablets */
    }
}

/* Mobile Devices (max-width: 768px) */
@media screen and (max-width: 768px) {
    .container {
        padding: 0 20px;
    }
    
    /* Typography Scaling */
    .hero-title {
        font-size: 2.5rem;
    }
    .hero-subtitle {
        font-size: 1.2rem;
    }
    .section-title {
        font-size: 2rem;
        margin-bottom: 2rem;
    }
    
    /* Layout Adjustments */
    .projects-grid {
        grid-template-columns: 1fr; /* 1 column on mobile */
        gap: 1.5rem;
    }
    .experience-list {
        padding: 0;
    }
    .experience-card-brittany {
        padding: 1.5rem;
        flex-direction: column;
    }
    .experience-time {
        margin-bottom: 1rem;
        min-width: 100%;
    }
    
    /* Navbar adjustments if not already handled */
    .nav-links {
        display: none; /* Hide default nav links, assuming hamburger menu handles it */
    }
    .hamburger {
        display: flex; /* Show hamburger menu */
    }
    
    /* Remove hover 3D tilt and effects on touch devices */
    .premium-project-card, .experience-card-brittany {
        transform: none !important;
        transition: none !important;
    }
    .premium-project-card:hover::after, .experience-card-brittany:hover::after {
        opacity: 0; /* Disable spotlight on mobile */
    }
    .cursor-trail {
        display: none; /* Hide magic cursor on mobile touch screens */
    }
}

/* Small Mobile Devices (max-width: 480px) */
@media screen and (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    .hero-buttons {
        flex-direction: column;
        width: 100%;
    }
    .btn-primary, .btn-outline {
        width: 100%;
        text-align: center;
    }
    .glass-id-card {
        width: 100%;
        height: auto;
    }
}
"""

with open(css_path, "a", encoding="utf-8") as f:
    f.write(responsive_css)

print("Responsive rules applied!")
