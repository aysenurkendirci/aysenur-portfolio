// Validates src/data.json before every build.
// The build stops with a list of problems if anything here fails, so broken or
// unsafe content never reaches index.html.
//
// Run on its own:  node scripts/validate-data.js

const fs = require('fs');
const path = require('path');

const ALLOWED_LINK_HOSTS = ['github.com', 'www.github.com', 'linkedin.com', 'www.linkedin.com'];
const LANGS = ['en', 'tr'];
const MAX_TEXT = 1200;

// Personal data that must never be published
const PHONE_PATTERNS = [
    /\+\s?90[\s\-.]?\(?\d{3}\)?[\s\-.]?\d{3}[\s\-.]?\d{2}[\s\-.]?\d{2}/,   // +90 5xx xxx xx xx
    /\b0?5\d{2}[\s\-.]?\d{3}[\s\-.]?\d{2}[\s\-.]?\d{2}\b/,                 // 05xx xxx xx xx
    /\b\d{3}[\s\-.]\d{3}[\s\-.]\d{2}[\s\-.]\d{2}\b/                        // xxx xxx xx xx
];
const MARKUP_PATTERN = /[<>]|\{\{|\}\}|javascript:/i;
const EMAIL_PATTERN = /^[^\s@<>"']+@[^\s@<>"']+\.[a-z]{2,}$/i;

function validateData(data, rootDir) {
    const problems = [];
    const fail = (where, msg) => problems.push(`${where}: ${msg}`);

    const isNonEmptyString = (v) => typeof v === 'string' && v.trim().length > 0;

    function checkText(where, value, { required = true } = {}) {
        if (value === undefined || value === null || value === '') {
            if (required) fail(where, 'boş olamaz');
            return;
        }
        if (typeof value !== 'string') {
            fail(where, 'metin olmalı');
            return;
        }
        if (value.length > MAX_TEXT) fail(where, `çok uzun (${value.length} > ${MAX_TEXT} karakter)`);
        if (MARKUP_PATTERN.test(value)) fail(where, 'HTML, şablon ifadesi veya javascript: içeremez');
        if (PHONE_PATTERNS.some((re) => re.test(value))) fail(where, 'telefon numarası içeriyor (kişisel bilgi yayınlanmamalı)');
    }

    function checkBilingual(where, obj, { required = true } = {}) {
        if (!obj || typeof obj !== 'object') {
            if (required) fail(where, '{ en, tr } nesnesi olmalı');
            return;
        }
        LANGS.forEach((lang) => checkText(`${where}.${lang}`, obj[lang], { required }));
        if (required && isNonEmptyString(obj.en) !== isNonEmptyString(obj.tr)) {
            fail(where, 'İngilizce ve Türkçe çevirilerin ikisi de dolu olmalı');
        }
    }

    function checkLink(where, value) {
        if (!isNonEmptyString(value)) return fail(where, 'link boş olamaz');
        let url;
        try {
            url = new URL(value);
        } catch {
            return fail(where, `geçerli bir URL değil: ${value}`);
        }
        if (url.protocol !== 'https:') fail(where, 'yalnızca https linklere izin var');
        if (!ALLOWED_LINK_HOSTS.includes(url.hostname)) fail(where, `izin verilmeyen alan adı: ${url.hostname}`);
        if (url.username || url.password) fail(where, 'link içinde kullanıcı bilgisi olamaz');
    }

    function checkLocalFile(where, relPath, extensions) {
        if (!isNonEmptyString(relPath)) return fail(where, 'dosya yolu boş olamaz');
        if (relPath.includes('..') || path.isAbsolute(relPath) || /^[a-z]+:/i.test(relPath)) {
            return fail(where, 'yalnızca proje içi göreli yol olabilir');
        }
        if (!extensions.includes(path.extname(relPath).toLowerCase())) {
            fail(where, `uzantı ${extensions.join(', ')} olmalı`);
        }
        if (!fs.existsSync(path.join(rootDir, relPath))) fail(where, `dosya bulunamadı: ${relPath}`);
    }

    function checkIcon(where, value) {
        if (!isNonEmptyString(value)) return fail(where, 'ikon sınıfı boş olamaz');
        if (!/^[a-z0-9\- ]+$/i.test(value)) fail(where, 'ikon sınıfı yalnızca harf, rakam, tire ve boşluk içerebilir');
    }

    function checkArray(where, value, { min = 1 } = {}) {
        if (!Array.isArray(value)) {
            fail(where, 'liste olmalı');
            return false;
        }
        if (value.length < min) fail(where, `en az ${min} öğe olmalı`);
        return true;
    }

    // ---------- profile ----------
    const profile = data.profile || {};
    checkText('profile.name', profile.name);
    checkBilingual('profile.title', profile.title);
    checkBilingual('profile.description', profile.description);
    if (!EMAIL_PATTERN.test(profile.email || '')) fail('profile.email', 'geçerli bir e-posta değil');
    checkLink('profile.github', profile.github);
    checkLink('profile.linkedin', profile.linkedin);
    checkLocalFile('profile.cv', profile.cv, ['.pdf']);
    checkLocalFile('profile.image', profile.image, ['.jpg', '.jpeg', '.png', '.webp']);

    // ---------- about ----------
    if (checkArray('aboutTexts', data.aboutTexts)) {
        data.aboutTexts.forEach((t, i) => checkBilingual(`aboutTexts[${i}]`, t));
    }

    // ---------- education + languages ----------
    const edu = data.education || {};
    checkText('education.school', edu.school);
    checkText('education.school_tr', edu.school_tr);
    checkBilingual('education.degree', edu.degree);
    checkBilingual('education.date', edu.date);
    if (checkArray('languages', data.languages)) {
        data.languages.forEach((l, i) => checkBilingual(`languages[${i}]`, l));
    }

    // ---------- tech ----------
    if (checkArray('techCategories', data.techCategories)) {
        data.techCategories.forEach((cat, i) => {
            const w = `techCategories[${i}]`;
            checkBilingual(`${w}.title`, cat.title);
            checkIcon(`${w}.catIcon`, cat.catIcon);
            if (checkArray(`${w}.items`, cat.items)) {
                cat.items.forEach((item, j) => {
                    checkText(`${w}.items[${j}].name`, item.name);
                    checkIcon(`${w}.items[${j}].icon`, item.icon);
                    checkBilingual(`${w}.items[${j}].tooltip`, item.tooltip);
                });
            }
        });
    }

    // ---------- experience ----------
    if (checkArray('experiences', data.experiences)) {
        data.experiences.forEach((exp, i) => {
            const w = `experiences[${i}]`;
            checkBilingual(`${w}.title`, exp.title);
            checkBilingual(`${w}.date`, exp.date);
            checkBilingual(`${w}.description`, exp.description);
            checkText(`${w}.company`, exp.company);
            checkIcon(`${w}.icon`, exp.icon);
            if (checkArray(`${w}.items`, exp.items)) {
                exp.items.forEach((it, j) => checkBilingual(`${w}.items[${j}]`, it));
            }
            if (checkArray(`${w}.techList`, exp.techList)) {
                exp.techList.forEach((t, j) => checkText(`${w}.techList[${j}]`, t));
            }
        });
    }

    // ---------- projects ----------
    if (checkArray('projects', data.projects)) {
        const titles = new Set();
        data.projects.forEach((p, i) => {
            const w = `projects[${i}]`;
            checkText(`${w}.title`, p.title);
            if (titles.has(p.title)) fail(`${w}.title`, `aynı başlık iki kez kullanılmış: ${p.title}`);
            titles.add(p.title);
            checkBilingual(`${w}.category`, p.category);
            checkBilingual(`${w}.context`, p.context);
            checkBilingual(`${w}.description`, p.description);
            checkLink(`${w}.github`, p.github);
            checkIcon(`${w}.icon`, p.icon);
            if (typeof p.featured !== 'boolean') fail(`${w}.featured`, 'true veya false olmalı');
            if (checkArray(`${w}.tech`, p.tech)) {
                p.tech.forEach((t, j) => checkText(`${w}.tech[${j}]`, t));
            }
        });
    }

    // ---------- certificates ----------
    if (checkArray('certificates', data.certificates)) {
        data.certificates.forEach((c, i) => {
            checkBilingual(`certificates[${i}].name`, c.name);
            checkBilingual(`certificates[${i}].issuer`, c.issuer);
        });
    }

    // ---------- whole-file safety net ----------
    const raw = JSON.stringify(data);
    if (PHONE_PATTERNS.some((re) => re.test(raw))) {
        fail('data.json', 'dosyanın bir yerinde telefon numarası var');
    }

    return problems;
}

module.exports = { validateData };

if (require.main === module) {
    const root = path.join(__dirname, '..');
    const data = JSON.parse(fs.readFileSync(path.join(root, 'src', 'data.json'), 'utf8'));
    const problems = validateData(data, root);
    if (problems.length) {
        console.error(`✗ ${problems.length} sorun bulundu:`);
        problems.forEach((p) => console.error(`  - ${p}`));
        process.exit(1);
    }
    console.log('✓ data.json geçerli');
}
