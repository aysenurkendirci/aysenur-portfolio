// Portfolio Site - Client-side interactions
// Dil (TR/EN), tema (koyu/açık), mobil menü, kitap sayfası geçişi,
// giriş animasyonları, kart ışığı ve proje kartı eğimi.
//
// Güvenlik notları:
// - Depodan okunan değerler yalnızca izin listesindeki değerlerse kullanılır.
// - Metinler her zaman textContent ile yazılır (HTML olarak yorumlanmaz).
// - localStorage erişimi try/catch içindedir; engelliyse site yine çalışır.

(function () {
    "use strict";

    const LANGS = ["tr", "en"];
    const THEMES = ["dark-theme", "light-theme"];
    const DEFAULT_LANG = "tr";
    const DEFAULT_THEME = "dark-theme";

    const root = document.documentElement;
    const pageBody = document.body;
    const menuToggleButton = document.getElementById("menuToggle");
    const navigationLinks = document.getElementById("navLinks");
    const themeToggleButton = document.getElementById("themeToggle");
    const languageToggleButton = document.getElementById("langToggle");

    const motionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
    const prefersReducedMotion = () => motionQuery.matches;

    // ---------- Güvenli depolama ----------

    function storageGet(key) {
        try {
            return window.localStorage.getItem(key);
        } catch (error) {
            return null;
        }
    }

    function storageSet(key, value) {
        try {
            window.localStorage.setItem(key, value);
        } catch (error) {
            /* depolama kapalı: tercih yalnızca bu sayfa için geçerli */
        }
    }

    const pick = (value, allowed, fallback) => (allowed.includes(value) ? value : fallback);

    // ---------- Dil ----------

    function currentLanguage() {
        return pick(root.lang, LANGS, DEFAULT_LANG);
    }

    function applyLanguage(requested) {
        const lang = pick(requested, LANGS, DEFAULT_LANG);
        root.lang = lang;

        document.querySelectorAll("[data-en][data-tr]").forEach((el) => {
            const text = el.dataset[lang];
            if (typeof text === "string" && text.length) el.textContent = text;
        });

        document.querySelectorAll("[data-alt-en][data-alt-tr]").forEach((el) => {
            el.alt = lang === "en" ? el.dataset.altEn : el.dataset.altTr;
        });

        document.querySelectorAll("[data-tooltip-en][data-tooltip-tr]").forEach((el) => {
            el.setAttribute("data-tooltip", lang === "en" ? el.dataset.tooltipEn : el.dataset.tooltipTr);
        });

        if (languageToggleButton) {
            const label = languageToggleButton.querySelector(".tool-label");
            if (label) label.textContent = lang === "en" ? "TR" : "EN";
            languageToggleButton.setAttribute(
                "aria-label",
                lang === "en" ? "Türkçeye geç" : "Switch to English"
            );
        }

        storageSet("portfolio-language", lang);
    }

    // ---------- Tema ----------

    function currentTheme() {
        return pageBody.classList.contains("light-theme") ? "light-theme" : "dark-theme";
    }

    function applyTheme(requested) {
        const theme = pick(requested, THEMES, DEFAULT_THEME);
        pageBody.classList.remove(...THEMES);
        pageBody.classList.add(theme);
        root.style.colorScheme = theme === "light-theme" ? "light" : "dark";

        if (themeToggleButton) {
            const label = themeToggleButton.querySelector(".tool-label");
            if (label) label.textContent = theme === "dark-theme" ? "☾" : "☀";
            themeToggleButton.setAttribute("aria-pressed", String(theme === "light-theme"));
            themeToggleButton.setAttribute(
                "aria-label",
                theme === "dark-theme" ? "Açık temaya geç" : "Koyu temaya geç"
            );
        }

        storageSet("portfolio-theme", theme);
    }

    // Tercihleri hemen uygula (script sayfanın sonunda, DOM hazır)
    applyLanguage(window.__initialLanguage || storageGet("portfolio-language"));
    applyTheme(window.__initialTheme || storageGet("portfolio-theme"));

    if (languageToggleButton) {
        languageToggleButton.addEventListener("click", () => {
            applyLanguage(currentLanguage() === "en" ? "tr" : "en");
        });
    }

    if (themeToggleButton) {
        themeToggleButton.addEventListener("click", () => {
            applyTheme(currentTheme() === "dark-theme" ? "light-theme" : "dark-theme");
        });
    }

    // ---------- Mobil menü ----------

    function setMenu(open) {
        if (!menuToggleButton || !navigationLinks) return;
        navigationLinks.classList.toggle("active", open);
        menuToggleButton.setAttribute("aria-expanded", String(open));
    }

    if (menuToggleButton && navigationLinks) {
        setMenu(false);
        menuToggleButton.addEventListener("click", (event) => {
            event.stopPropagation();
            setMenu(!navigationLinks.classList.contains("active"));
        });
        // Dışarı tıklayınca veya Escape ile kapanır
        document.addEventListener("click", (event) => {
            if (navigationLinks.classList.contains("active") && !navigationLinks.contains(event.target)) {
                setMenu(false);
            }
        });
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && navigationLinks.classList.contains("active")) {
                setMenu(false);
                menuToggleButton.focus();
            }
        });
        // Masaüstüne genişleyince açık kalmasın
        window.matchMedia("(min-width: 769px)").addEventListener("change", (e) => {
            if (e.matches) setMenu(false);
        });
    }

    // ---------- E-posta ----------
    // Masaüstünde Gmail'in e-posta yazma ekranı yeni sekmede açılır (çoğu
    // bilgisayarda mailto için kurulu bir e-posta programı yoktur). Telefonda
    // cihazın e-posta uygulaması açılır. İkisinde de alıcı ve konu hazırdır.
    const EMAIL_PATTERN = /^[^\s@<>"'?&]+@[^\s@<>"'?&]+\.[a-z]{2,}$/i;
    const MAIL_SUBJECT = { tr: "Portfolyo üzerinden iletişim", en: "Contact via portfolio" };
    const desktopPointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;

    document.querySelectorAll('a[href^="mailto:"]').forEach((link) => {
        const email = link.getAttribute("href").slice(7).split("?")[0];
        if (!EMAIL_PATTERN.test(email)) return;
        link.addEventListener("click", (event) => {
            const subject = encodeURIComponent(MAIL_SUBJECT[currentLanguage()]);
            if (desktopPointer) {
                event.preventDefault();
                const url = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(email)}&su=${subject}`;
                window.open(url, "_blank", "noopener,noreferrer");
            } else {
                link.setAttribute("href", `mailto:${email}?subject=${subject}`);
            }
        });
    });

    // Adresi kopyala (Gmail kullanmayanlar için)
    document.querySelectorAll("[data-copy]").forEach((button) => {
        const label = button.querySelector("span");
        let timer = null;
        button.addEventListener("click", async () => {
            const lang = currentLanguage();
            let ok = false;
            try {
                await navigator.clipboard.writeText(button.dataset.copy);
                ok = true;
            } catch (error) {
                ok = false;
            }
            const texts = ok
                ? { tr: "Kopyalandı", en: "Copied" }
                : { tr: "Kopyalanamadı", en: "Couldn't copy" };
            label.textContent = texts[lang];
            button.classList.toggle("is-copied", ok);
            window.clearTimeout(timer);
            timer = window.setTimeout(() => {
                label.textContent = label.dataset[currentLanguage()];
                button.classList.remove("is-copied");
            }, 1800);
        });
    });

    // ---------- Kitap sayfası geçişi ----------
    // Menüdeki bir bölüme gidilince ekranı bir sayfa kaplar, üzerinde bölümün adı
    // yazar; arkada sayfa hedef bölüme kayar, sonra sayfa soldaki cilt çizgisinden
    // çevrilerek açılır.

    const pageTurn = document.querySelector(".page-turn");
    const pageTurnTitle = pageTurn ? pageTurn.querySelector(".page-turn-title") : null;
    const COVER_MS = 300;
    const TURN_MS = 750;
    let turning = false;

    function jumpTo(target) {
        target.scrollIntoView({ behavior: "instant", block: "start" });
        const heading = target.querySelector("h1, h2") || target;
        if (!heading.hasAttribute("tabindex")) heading.setAttribute("tabindex", "-1");
        heading.focus({ preventScroll: true });
    }

    function goToSection(target, id) {
        setMenu(false);
        if (window.location.hash !== `#${id}`) {
            history.pushState(null, "", `#${id}`);
        }

        if (!pageTurn || prefersReducedMotion() || turning) {
            jumpTo(target);
            return;
        }

        turning = true;
        const heading = target.querySelector("h1, h2");
        pageTurnTitle.textContent = heading ? heading.textContent.trim() : "";

        pageTurn.classList.remove("is-turning");
        pageTurn.classList.add("is-active");

        window.setTimeout(() => {
            jumpTo(target);
            // Bir kare bekleyip çevirmeye başla ki kaydırma tamamlanmış olsun
            requestAnimationFrame(() => {
                pageTurn.classList.add("is-turning");
                window.setTimeout(() => {
                    pageTurn.classList.remove("is-active", "is-turning");
                    turning = false;
                }, TURN_MS);
            });
        }, COVER_MS);
    }

    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        const id = link.getAttribute("href").slice(1);
        if (!id || id === "main-content" || !/^[a-z][\w-]*$/i.test(id)) return;
        link.addEventListener("click", (event) => {
            const target = document.getElementById(id);
            if (!target) return;
            event.preventDefault();
            goToSection(target, id);
        });
    });

    // ---------- Giriş animasyonları, kart ışığı, eğim ----------
    // "Hareketi azalt" açıksa ya da IntersectionObserver yoksa içerik doğrudan görünür.

    const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;

    document.querySelectorAll("[data-stagger]").forEach((group) => {
        Array.from(group.children).forEach((child, index) => {
            child.style.setProperty("--d", `${Math.min(index, 8) * 90}ms`);
        });
    });
    document.querySelectorAll(".chip-list").forEach((list) => {
        Array.from(list.children).forEach((chip, index) => {
            chip.style.setProperty("--i", String(Math.min(index, 12)));
        });
    });

    const revealTargets = document.querySelectorAll(".rise, .thread-entry, [data-thread]");

    function revealAll() {
        revealTargets.forEach((el) => el.classList.add("is-in", "is-drawn", "is-done"));
    }

    if (prefersReducedMotion() || !("IntersectionObserver" in window)) {
        revealAll();
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                if (el.hasAttribute("data-thread")) {
                    el.classList.add("is-drawn");
                } else {
                    el.classList.add("is-in");
                    const delay = parseInt(el.style.getPropertyValue("--d"), 10) || 0;
                    window.setTimeout(() => el.classList.add("is-done"), delay + 1400);
                }
                observer.unobserve(el);
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" });

        revealTargets.forEach((el) => observer.observe(el));
    }

    // Kullanıcı sonradan "hareketi azalt"ı açarsa her şey hemen görünür olsun
    motionQuery.addEventListener("change", (e) => {
        if (e.matches) revealAll();
    });

    if (finePointer) {
        document.querySelectorAll(".glow-card").forEach((card) => {
            card.addEventListener("pointermove", (event) => {
                const rect = card.getBoundingClientRect();
                card.style.setProperty("--mx", `${event.clientX - rect.left}px`);
                card.style.setProperty("--my", `${event.clientY - rect.top}px`);

                if (!prefersReducedMotion() && card.hasAttribute("data-tilt")) {
                    const px = (event.clientX - rect.left) / rect.width - 0.5;
                    const py = (event.clientY - rect.top) / rect.height - 0.5;
                    card.style.setProperty("--tilt-y", `${(px * 6).toFixed(2)}deg`);
                    card.style.setProperty("--tilt-x", `${(-py * 6).toFixed(2)}deg`);
                }
            });
            card.addEventListener("pointerleave", () => {
                card.style.setProperty("--tilt-x", "0deg");
                card.style.setProperty("--tilt-y", "0deg");
            });
        });
    }

    // ---------- İmleç efekti ----------
    // Farenin ucunda bir nokta (anında takip eder, gecikme yok) ve onu yumuşakça
    // izleyen bir halka. Bağlantı/düğme üstünde halka büyüyüp yeşile döner,
    // tıklayınca küçülür. Sistem imleci yerinde kalır. Yalnızca gerçek fare +
    // hareketi azalt kapalıyken; hareket bitince döngü durur (boşta CPU harcamaz).
    if (finePointer && !prefersReducedMotion()) {
        const dot = document.createElement("div");
        const ring = document.createElement("div");
        dot.className = "cursor-dot";
        ring.className = "cursor-ring";
        dot.setAttribute("aria-hidden", "true");
        ring.setAttribute("aria-hidden", "true");
        document.body.append(dot, ring);

        let mouseX = -100;
        let mouseY = -100;
        let ringX = mouseX;
        let ringY = mouseY;
        let frame = null;

        const follow = () => {
            ringX += (mouseX - ringX) * 0.2;
            ringY += (mouseY - ringY) * 0.2;
            ring.style.transform = `translate3d(${ringX}px, ${ringY}px, 0)`;
            frame = Math.abs(mouseX - ringX) > 0.2 || Math.abs(mouseY - ringY) > 0.2
                ? requestAnimationFrame(follow)
                : null;
        };

        document.addEventListener("pointermove", (event) => {
            if (event.pointerType !== "mouse") return;
            mouseX = event.clientX;
            mouseY = event.clientY;
            dot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
            if (!root.classList.contains("cursor-on")) {
                ringX = mouseX;
                ringY = mouseY;
                root.classList.add("cursor-on");
            }
            const over = event.target instanceof Element
                && event.target.closest("a, button, [tabindex], .chip, summary, label");
            root.classList.toggle("cursor-hover", Boolean(over));
            if (!frame) frame = requestAnimationFrame(follow);
        }, { passive: true });

        document.addEventListener("pointerdown", () => root.classList.add("cursor-press"));
        document.addEventListener("pointerup", () => root.classList.remove("cursor-press"));
        document.documentElement.addEventListener("mouseleave", () => {
            root.classList.remove("cursor-on", "cursor-hover", "cursor-press");
        });
        motionQuery.addEventListener("change", (e) => {
            if (e.matches) {
                dot.remove();
                ring.remove();
            }
        });
    }
})();


// ==================================================
// KULLANILMAYAN ESKİ KODLAR (yorum satırında saklanıyor)
// ==================================================

/* KULLANILMIYOR: iletişim formu gönderimi (sayfada form yok)
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
*/

/* KULLANILMIYOR: eski yumuşak kaydırma (yerini kitap sayfası geçişi aldı)
// Smooth Scroll for Navbar Links
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', function(e) {
        if (this.getAttribute('target') === '_blank') return;
        
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetEl = document.getElementById(targetId);
        
        if(targetEl) {
            targetEl.scrollIntoView({
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const navLinks = document.getElementById('navLinks');
            const menuToggle = document.getElementById('menuToggle');
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });
});
*/

/* KULLANILMIYOR: imleç parıltısı kaldırıldı
const cursorGlowElement = document.getElementById("cursorGlow");
*/

/* KULLANILMIYOR: imleç parıltısı kaldırıldı
// Cursor glow effect - follows mouse movement
document.addEventListener("mousemove", (event) => {
    if (!cursorGlowElement) return;
    cursorGlowElement.style.left = `${event.clientX}px`;
    cursorGlowElement.style.top = `${event.clientY}px`;
});

*/

/* KULLANILMIYOR: imleç parıltısı kaldırıldı
// Interactive Cursor Glow
const cursorGlow = document.getElementById('cursorGlow');
if (cursorGlow) {
    document.addEventListener('mousemove', (e) => {
        // Use requestAnimationFrame for smoother performance
        requestAnimationFrame(() => {
            cursorGlow.style.left = e.clientX + 'px';
            cursorGlow.style.top = e.clientY + 'px';
        });
    });
    
    // Add fancy hover effect when over clickable items
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('mouseenter', () => cursorGlow.style.transform = 'translate(-50%, -50%) scale(1.5)');
        el.addEventListener('mouseleave', () => cursorGlow.style.transform = 'translate(-50%, -50%) scale(1)');
    });
}
*/

/* KULLANILMIYOR: eski reveal-left/right/zoom animasyonları (yerine aşağıdaki tek seferlik görünme kodu geldi)
document.addEventListener('DOMContentLoaded', () => {
    // Scroll Reveal Effect
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom, .reveal-up, .reveal-target');
    
    // Add reveal class to all sections by default if not present
    revealElements.forEach(el => {
        if(!el.classList.contains('reveal')) {
            el.classList.add('reveal');
        }
    });

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                // Optional: Stop observing once revealed
                // observer.unobserve(entry.target); 
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    });

    revealElements.forEach(el => revealObserver.observe(el));
});
*/

/* KULLANILMIYOR: kart spot ışığı efekti kaldırıldı
document.addEventListener('DOMContentLoaded', () => {
    // Spotlight Effect for Cards
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
*/
