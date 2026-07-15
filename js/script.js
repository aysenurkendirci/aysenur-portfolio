// Portfolio Site - Client-side interactions
// Manages: language toggle (EN/TR), theme toggle (dark/light), mobile menu, cursor effect


const cursorGlowElement = document.getElementById("cursorGlow");
const menuToggleButton = document.getElementById("menuToggle");
const navigationLinks = document.getElementById("navLinks");
const themeToggleButton = document.getElementById("themeToggle");
const languageToggleButton = document.getElementById("langToggle");
const pageBody = document.body;

// Cursor glow effect - follows mouse movement
document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;
    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

// Mobile menu toggle
if (menuToggleButton && navigationLinks) {
    menuToggleButton.addEventListener("click", () => {
        navigationLinks.classList.toggle("active");
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    });
}

// Language switching - apply selected language to all multilingual elements
function applyLanguage(selectedLanguage) {
    // Update HTML lang attribute for accessibility
    document.documentElement.lang = selectedLanguage;

    // Update text elements with data-en and data-tr attributes
    const textElements = document.querySelectorAll("[data-en][data-tr]");
    textElements.forEach((el) => {
        el.textContent = el.dataset[selectedLanguage];
    });

    // Update image alt attributes
    const imageElements = document.querySelectorAll("[data-alt-en][data-alt-tr]");
    imageElements.forEach((el) => {
        el.alt = selectedLanguage === "en" ? el.dataset.altEn : el.dataset.altTr;
    });

    // Update form placeholders
    const placeholderElements = document.querySelectorAll(
        "[data-placeholder-en][data-placeholder-tr]"
    );
    placeholderElements.forEach((el) => {
        el.placeholder =
            selectedLanguage === "en"
                ? el.dataset.placeholderEn
                : el.dataset.placeholderTr;
    });

    // Update tooltips
    const tooltipElements = document.querySelectorAll(
        "[data-tooltip-en][data-tooltip-tr]"
    );
    tooltipElements.forEach((el) => {
        const tooltipText =
            selectedLanguage === "en"
                ? el.dataset.tooltipEn
                : el.dataset.tooltipTr;
        el.setAttribute("data-tooltip", tooltipText);
    });

    // Update language toggle button label
    if (languageToggleButton) {
        const label = languageToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedLanguage === "en" ? "TR" : "EN";
        }
    }

    // Save preference
    localStorage.setItem("portfolio-language", selectedLanguage);
}

// Theme switching - apply selected theme (dark-theme or light-theme)
function applyTheme(selectedTheme) {
    // Remove previous theme classes
    pageBody.classList.remove("dark-theme", "light-theme");
    
    // Add new theme class
    pageBody.classList.add(selectedTheme);

    // Update theme toggle button label (moon/sun icon)
    if (themeToggleButton) {
        const label = themeToggleButton.querySelector(".tool-label");
        if (label) {
            label.textContent = selectedTheme === "dark-theme" ? "☾" : "☀";
        }
    }

    // Save preference
    localStorage.setItem("portfolio-theme", selectedTheme);
}

// Language toggle button - click event
if (languageToggleButton) {
    languageToggleButton.addEventListener("click", () => {
        const currentLanguage =
            localStorage.getItem("portfolio-language") || "tr";
        const nextLanguage = currentLanguage === "en" ? "tr" : "en";
        applyLanguage(nextLanguage);
    });
}

// Theme toggle button - click event
if (themeToggleButton) {
    themeToggleButton.addEventListener("click", () => {
        const currentTheme =
            localStorage.getItem("portfolio-theme") || "dark-theme";
        const nextTheme =
            currentTheme === "dark-theme" ? "light-theme" : "dark-theme";
        applyTheme(nextTheme);
    });
}

// Initialize on page load - restore user preferences
document.addEventListener("DOMContentLoaded", () => {
    // Load saved language preference
    const savedLanguage =
        localStorage.getItem("portfolio-language") || "tr";

    // Load saved theme preference
    const savedTheme =
        localStorage.getItem("portfolio-theme") || "dark-theme";

    // Apply saved preferences
    applyLanguage(savedLanguage);
    applyTheme(savedTheme);

    // Set initial menu state for accessibility
    if (menuToggleButton && navigationLinks) {
        const isMenuOpen = navigationLinks.classList.contains("active");
        menuToggleButton.setAttribute("aria-expanded", isMenuOpen.toString());
    }

    // AJAX-based Contact Form Submission
    const contactForm = document.querySelector(".contact-form");
    if (contactForm && contactForm.tagName === "FORM") {
        contactForm.addEventListener("submit", async (event) => {
            event.preventDefault();
            
            // Clear previous feedback messages
            let feedbackEl = contactForm.querySelector(".form-feedback");
            if (feedbackEl) {
                feedbackEl.remove();
            }
            
            // Input Elements
            const nameInput = contactForm.querySelector("#name");
            const emailInput = contactForm.querySelector("#email");
            const messageInput = contactForm.querySelector("#message");
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const submitBtnText = submitBtn ? submitBtn.querySelector("span") : null;
            
            const currentLang = localStorage.getItem("portfolio-language") || "tr";
            
            const messages = {
                en: {
                    empty: "Please fill in all fields.",
                    email: "Please enter a valid email address.",
                    sending: "Sending...",
                    success: "Message sent! Thank you.",
                    error: "Something went wrong. Please try again."
                },
                tr: {
                    empty: "Lütfen tüm alanları doldurun.",
                    email: "Lütfen geçerli bir e-posta adresi girin.",
                    sending: "Gönderiliyor...",
                    success: "Mesajınız iletildi! Teşekkürler.",
                    error: "Bir sorun oluştu. Lütfen tekrar deneyin."
                }
            };

            const t = messages[currentLang];
            
            // Validation checks
            if (!nameInput.value.trim() || !emailInput.value.trim() || !messageInput.value.trim()) {
                showFeedback(t.empty, "error");
                return;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                showFeedback(t.email, "error");
                return;
            }
            
            // Set Loading state
            if (submitBtn) submitBtn.disabled = true;
            let originalBtnText = "";
            if (submitBtnText) {
                originalBtnText = submitBtnText.textContent;
                submitBtnText.textContent = t.sending;
            }
            
            // Check if Web3Forms key is unconfigured (still a placeholder)
            const accessKeyInput = contactForm.querySelector('input[name="access_key"]');
            if (accessKeyInput && (accessKeyInput.value === "YOUR_WEB3FORMS_ACCESS_KEY_HERE" || !accessKeyInput.value)) {
                const subject = encodeURIComponent("Portfolio İletişim - " + nameInput.value.trim());
                const body = encodeURIComponent(messageInput.value.trim() + "\n\nKimden: " + nameInput.value.trim() + " <" + emailInput.value.trim() + ">");
                window.location.href = `mailto:aysenurkendirciss@gmail.com?subject=${subject}&body=${body}`;
                showFeedback(t.success, "success");
                contactForm.reset();
                if (submitBtn) submitBtn.disabled = false;
                if (submitBtnText) submitBtnText.textContent = originalBtnText;
                return;
            }
            
            try {
                const formData = new FormData(contactForm);
                const response = await fetch(contactForm.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "Accept": "application/json"
                    }
                });
                
                if (response.ok) {
                    showFeedback(t.success, "success");
                    contactForm.reset();
                } else {
                    showFeedback(t.error, "error");
                }
            } catch (error) {
                console.error("Form submission error:", error);
                showFeedback(t.error, "error");
            } finally {
                if (submitBtn) submitBtn.disabled = false;
                if (submitBtnText) submitBtnText.textContent = originalBtnText;
            }
            
            function showFeedback(msg, type) {
                feedbackEl = document.createElement("div");
                feedbackEl.className = `form-feedback ${type}`;
                feedbackEl.textContent = msg;
                
                // Styles matching dark-theme glassmorphism aesthetics
                feedbackEl.style.padding = "12px 16px";
                feedbackEl.style.marginTop = "16px";
                feedbackEl.style.marginBottom = "16px";
                feedbackEl.style.borderRadius = "8px";
                feedbackEl.style.fontSize = "0.95rem";
                feedbackEl.style.fontWeight = "500";
                feedbackEl.style.textAlign = "center";
                feedbackEl.style.border = "1px solid";
                
                if (type === "success") {
                    feedbackEl.style.backgroundColor = "rgba(16, 185, 129, 0.1)";
                    feedbackEl.style.borderColor = "rgba(16, 185, 129, 0.3)";
                    feedbackEl.style.color = "#34D399";
                } else {
                    feedbackEl.style.backgroundColor = "rgba(239, 68, 68, 0.1)";
                    feedbackEl.style.borderColor = "rgba(239, 68, 68, 0.3)";
                    feedbackEl.style.color = "#F87171";
                }
                
                // Insert message above the submit button
                submitBtn.parentNode.insertBefore(feedbackEl, submitBtn);
            }
        });
    }
});