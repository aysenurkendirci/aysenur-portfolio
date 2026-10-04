import re

# 1. Update base.css for Scrollbar, Navbar Glassmorphism, and Typewriter
css_append = """
/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: #020c1b;
}
::-webkit-scrollbar-thumb {
    background: rgba(45, 212, 191, 0.3);
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
    background: rgba(45, 212, 191, 0.7);
}

/* Glassmorphism Sticky Navbar (if not already applied) */
.navbar {
    background: rgba(10, 25, 47, 0.7) !important;
    backdrop-filter: blur(12px) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

/* 3D Tilt Effect Setup */
.premium-project-card, .experience-card-brittany {
    transform-style: preserve-3d;
    perspective: 1000px;
}

/* Typewriter Effect cursor */
.typing-cursor::after {
    content: '|';
    animation: blink 1s step-start infinite;
    color: var(--primary-accent-color);
}
@keyframes blink {
    50% { opacity: 0; }
}
"""

with open("c:/Users/Asus/aysenur-portfolio/css/base.css", "a", encoding="utf-8") as f:
    f.write(css_append)

# 2. Add JS for 3D Tilt and Typewriter
js_append = """
document.addEventListener('DOMContentLoaded', () => {
    // 3D Tilt Effect for Cards
    const tiltCards = document.querySelectorAll('.premium-project-card, .experience-card-brittany');
    
    tiltCards.forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            // Calculate rotation (max 5 degrees)
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = ((y - centerY) / centerY) * -4;
            const rotateY = ((x - centerX) / centerX) * 4;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            card.style.transition = 'none'; // Remove transition during hover for instant follow
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
            card.style.transition = 'transform 0.5s cubic-bezier(0.23, 1, 0.32, 1)'; // Smooth reset
        });
    });
    
    // Typewriter effect for Tagline
    const taglines = document.querySelectorAll('.hero-subtitle');
    taglines.forEach(tagline => {
        // Only run on the active translated text, but we'll apply it via a typing function
        const originalText = tagline.textContent.trim();
        tagline.textContent = '';
        tagline.classList.add('typing-cursor');
        
        let i = 0;
        const typeWriter = () => {
            if (i < originalText.length) {
                tagline.textContent += originalText.charAt(i);
                i++;
                setTimeout(typeWriter, 35); // Typing speed
            } else {
                setTimeout(() => tagline.classList.remove('typing-cursor'), 2000);
            }
        };
        // Start typing after a short delay
        setTimeout(typeWriter, 800);
    });
});
"""

with open("c:/Users/Asus/aysenur-portfolio/js/script.js", "a", encoding="utf-8") as f:
    f.write(js_append)

print("More beauties added without committing!")
