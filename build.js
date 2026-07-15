const fs = require('fs');
const path = require('path');

// Configure directories
const SRC_DIR = path.join(__dirname, 'src');
const COMPONENTS_DIR = path.join(SRC_DIR, 'components');
const DIST_DIR = __dirname; // Compile directly into project root

// Load data.json
function loadData() {
    const dataPath = path.join(SRC_DIR, 'data.json');
    if (!fs.existsSync(dataPath)) {
        console.error(`Error: data.json not found at ${dataPath}`);
        process.exit(1);
    }
    const rawData = fs.readFileSync(dataPath, 'utf8');
    return JSON.parse(rawData);
}

// Custom simple template engine with support for nested tags
function renderTemplate(html, context) {
    let result = html;
    
    while (true) {
        // Find the first token of interest: {{#each , {{#if , {{#unless
        const tokens = [
            { type: 'each', open: '{{#each', close: '{{/each}}' },
            { type: 'if', open: '{{#if', close: '{{/if}}' },
            { type: 'unless', open: '{{#unless', close: '{{/unless}}' }
        ];
        
        let firstMatch = null;
        let firstMatchIndex = Infinity;
        
        for (const token of tokens) {
            const idx = result.indexOf(token.open);
            if (idx !== -1 && idx < firstMatchIndex) {
                firstMatchIndex = idx;
                firstMatch = token;
            }
        }
        
        if (!firstMatch) {
            // No more block tags!
            break;
        }
        
        // Find the opening tag name/parameter
        const openStart = firstMatchIndex;
        const openEnd = result.indexOf('}}', openStart);
        if (openEnd === -1) {
            break; // malformed template
        }
        
        const openTag = result.substring(openStart, openEnd + 2);
        // Extract parameter, e.g. "techCategories" from "{{#each techCategories}}"
        const param = openTag.substring(firstMatch.open.length, openTag.length - 2).trim();
        
        // Find matching close tag
        const contentStart = openEnd + 2;
        const closeIndex = findMatchingClose(result, firstMatch.open, firstMatch.close, contentStart);
        
        if (closeIndex === -1) {
            console.error(`Malformed template: no matching closing tag for ${openTag}`);
            break;
        }
        
        const innerContent = result.substring(contentStart, closeIndex);
        const fullBlockLength = (closeIndex + firstMatch.close.length) - openStart;
        
        // Process the block
        let blockReplacement = '';
        if (firstMatch.type === 'each') {
            const array = getValue(context, param);
            if (Array.isArray(array)) {
                array.forEach(item => {
                    const itemContext = typeof item === 'object' ? { ...item, parent: context } : { this: item, parent: context };
                    blockReplacement += renderTemplate(innerContent, itemContext);
                });
            }
        } else if (firstMatch.type === 'if') {
            const value = getValue(context, param);
            if (value) {
                blockReplacement = renderTemplate(innerContent, context);
            }
        } else if (firstMatch.type === 'unless') {
            const value = getValue(context, param);
            if (!value) {
                blockReplacement = renderTemplate(innerContent, context);
            }
        }
        
        // Replace in result string
        result = result.substring(0, openStart) + blockReplacement + result.substring(openStart + fullBlockLength);
    }
    
    // Now replace simple variables in the current context
    const varRegex = /\{\{([\w\.]+)\}\}/g;
    result = result.replace(varRegex, (m, key) => {
        const val = getValue(context, key);
        return val !== undefined ? val : m;
    });
    
    return result;
}

// Find matching closing tag for a given opening tag by counting depths
function findMatchingClose(str, openToken, closeToken, startIndex) {
    let depth = 1;
    let index = startIndex;
    
    while (depth > 0 && index < str.length) {
        const nextOpen = str.indexOf(openToken, index);
        const nextClose = str.indexOf(closeToken, index);
        
        if (nextClose === -1) {
            return -1;
        }
        
        if (nextOpen !== -1 && nextOpen < nextClose) {
            depth++;
            index = nextOpen + openToken.length;
        } else {
            depth--;
            index = nextClose + closeToken.length;
        }
    }
    
    return index - closeToken.length;
}

// Retrieve value from object by path (e.g. 'profile.name')
function getValue(obj, path) {
    if (path === 'this') return obj.this !== undefined ? obj.this : obj;
    const parts = path.split('.');
    let current = obj;
    for (let i = 0; i < parts.length; i++) {
        if (current == null) return undefined;
        current = current[parts[i]];
    }
    return current;
}

// Read component HTML and render it
function compileComponent(name, context) {
    const filePath = path.join(COMPONENTS_DIR, `${name}.html`);
    if (!fs.existsSync(filePath)) {
        console.warn(`Warning: Component ${name}.html not found at ${filePath}`);
        return '';
    }
    const html = fs.readFileSync(filePath, 'utf8');
    return renderTemplate(html, context);
}

// Main compiler execution
function build() {
    console.log('--- Starting Static Portfolio Build ---');
    
    // Load portfolio data
    const data = loadData();
    
    // Prepare complete template rendering context
    const context = {
        ...data,
        PROFILE_NAME: data.profile.name,
        PROFILE_ROLE_EN: data.profile.title.en,
        PROFILE_ROLE_TR: data.profile.title.tr,
        PROFILE_DESC_EN: data.profile.description.en,
        PROFILE_DESC_TR: data.profile.description.tr,
        PROFILE_CV: data.profile.cv,
        PROFILE_IMAGE: data.profile.image,
        PROFILE_GITHUB: data.profile.github,
        PROFILE_LINKEDIN: data.profile.linkedin,
        PROFILE_EMAIL: data.profile.email,
        
        CONTACT_INTRO_EN: data.contactForm.intro.en,
        CONTACT_INTRO_TR: data.contactForm.intro.tr,
        CONTACT_EMAIL_LABEL_EN: data.profile.contact_info.email_label.en,
        CONTACT_EMAIL_LABEL_TR: data.profile.contact_info.email_label.tr,
        CONTACT_GITHUB_LABEL_EN: data.profile.contact_info.github_label.en,
        CONTACT_GITHUB_LABEL_TR: data.profile.contact_info.github_label.tr,
        CONTACT_GITHUB_ACTION_EN: data.profile.contact_info.github_action.en,
        CONTACT_GITHUB_ACTION_TR: data.profile.contact_info.github_action.tr,
        CONTACT_LINKEDIN_LABEL_EN: data.profile.contact_info.linkedin_label.en,
        CONTACT_LINKEDIN_LABEL_TR: data.profile.contact_info.linkedin_label.tr,
        CONTACT_LINKEDIN_ACTION_EN: data.profile.contact_info.linkedin_action.en,
        CONTACT_LINKEDIN_ACTION_TR: data.profile.contact_info.linkedin_action.tr,
        
        CONTACT_SUBMIT_TEXT_EN: data.contactForm.submit.text.en,
        CONTACT_SUBMIT_TEXT_TR: data.contactForm.submit.text.tr,
        CONTACT_SUBMIT_ICON: data.contactForm.submit.icon,
        
        // Enrich fields with isTextarea helper
        contactFormFields: data.contactForm.fields.map(field => ({
            ...field,
            isTextarea: field.type === 'textarea'
        })),
        
        // Contact form submit endpoint and access key (configured for Web3Forms/Formspree)
        CONTACT_FORM_ACTION: data.contactForm.action || "https://api.web3forms.com/submit",
        CONTACT_FORM_ACCESS_KEY: data.contactForm.accessKey || ""
    };

    // Compile components
    console.log('Compiling components...');
    const navbarHtml = compileComponent('navbar', context);
    const heroHtml = compileComponent('hero', context);
    const aboutHtml = compileComponent('about', context);
    const skillsHtml = compileComponent('skills', context);
    const experienceHtml = compileComponent('experience', context);
    const projectsHtml = compileComponent('projects', context);
    const contactHtml = compileComponent('contact', context);
    const footerHtml = compileComponent('footer', context);

    // Load template shell
    const templatePath = path.join(SRC_DIR, 'template.html');
    if (!fs.existsSync(templatePath)) {
        console.error(`Error: template.html not found at ${templatePath}`);
        process.exit(1);
    }
    let templateHtml = fs.readFileSync(templatePath, 'utf8');

    // Replace component placeholders
    console.log('Injecting components into main shell template...');
    templateHtml = templateHtml.replace('{{NAVBAR}}', navbarHtml);
    templateHtml = templateHtml.replace('{{HERO}}', heroHtml);
    templateHtml = templateHtml.replace('{{ABOUT}}', aboutHtml);
    templateHtml = templateHtml.replace('{{SKILLS}}', skillsHtml);
    templateHtml = templateHtml.replace('{{EXPERIENCE}}', experienceHtml);
    templateHtml = templateHtml.replace('{{PROJECTS}}', projectsHtml);
    templateHtml = templateHtml.replace('{{CONTACT}}', contactHtml);
    templateHtml = templateHtml.replace('{{FOOTER}}', footerHtml);

    // Compile any global variables inside template.html directly
    templateHtml = renderTemplate(templateHtml, context);

    // Save final compiled file
    const outputPath = path.join(DIST_DIR, 'index.html');
    fs.writeFileSync(outputPath, templateHtml, 'utf8');
    console.log(`✓ Portfolio built successfully: ${outputPath}`);
    
    // Also build a success.html fallback page
    buildSuccessPage(context);
}

// Generate success.html fallback redirect page
function buildSuccessPage(context) {
    const successTemplate = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj Alındı | Kişisel Portföy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/base.css?v=1.1">
    <link rel="stylesheet" href="css/navbar.css?v=1.1">
    <link rel="stylesheet" href="css/hero.css?v=1.1">
    <link rel="stylesheet" href="css/content.css?v=1.1">
</head>
<body class="dark-theme">
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>
    
    <header class="site-header" role="banner">
        <nav class="navbar" aria-label="Ana navigasyon">
            <div class="container navbar-container">
                <a href="index.html#home" class="brand">
                    <span class="brand-line">
                        <span class="token-const">const</span>
                        <span class="token-var">developer</span>
                        <span class="token-eq">=</span>
                        <span class="token-string">"{{PROFILE_NAME}}"</span>
                        <span class="token-semi">;</span>
                        <span class="brand-cursor" aria-hidden="true"></span>
                    </span>
                </a>
            </div>
        </nav>
    </header>

    <main id="main-content">
        <section class="contact-result-section section" aria-labelledby="result-title">
            <div class="container">
                <article class="result-card" style="text-align: center; max-width: 600px; margin: 80px auto; padding: 40px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; backdrop-filter: blur(10px);">
                    <div class="result-icon success-icon" style="font-size: 4rem; color: #10B981; margin-bottom: 24px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <h1 id="result-title" class="result-title" style="font-size: 2rem; margin-bottom: 16px;" data-en="Message Sent!" data-tr="Mesaj Gönderildi!">
                        Message Sent!
                    </h1>

                    <p class="result-text" style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 24px;"
                       data-en="Thank you for getting in touch. I have received your message and will reply as soon as possible."
                       data-tr="Benimle iletişime geçtiğiniz için teşekkürler. Mesajınız bana ulaştı, en kısa sürede dönüş sağlayacağım.">
                        Thank you for getting in touch. I have received your message and will reply as soon as possible.
                    </p>

                    <a href="index.html#contact" class="btn" data-en="Back to Portfolio" data-tr="Portföye Geri Dön">
                        Back to Portfolio
                    </a>
                </article>
            </div>
        </section>
    </main>

    <footer class="footer" role="contentinfo">
        <div class="container footer-container">
            <p class="footer-text" data-en="&copy; 2026 {{PROFILE_NAME}}. All rights reserved." data-tr="&copy; 2026 {{PROFILE_NAME}}. Tüm hakları saklıdır.">
                &copy; 2026 {{PROFILE_NAME}}. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        (function() {
            const savedLanguage = localStorage.getItem('portfolio-language');
            const initialLanguage = savedLanguage || 'en';
            document.documentElement.lang = initialLanguage;
        })();
    </script>
    <script src="js/script.js"></script>
</body>
</html>`;

    const outputPath = path.join(DIST_DIR, 'success.html');
    const compiledSuccess = renderTemplate(successTemplate, context);
    fs.writeFileSync(outputPath, compiledSuccess, 'utf8');
    console.log(`✓ Success fallback built successfully: ${outputPath}`);
}

// Execute build
build();
