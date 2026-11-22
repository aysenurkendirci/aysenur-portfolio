// Tarayıcı testleri: gerçek Chrome/Edge ile sayfayı açar ve kontrol eder.
// - Hiçbir ekran boyutunda, temada ve dilde yatay kaydırma olmamalı
// - Menü, kitap sayfası geçişi, mobil menü, dil ve tema düğmeleri çalışmalı
// - Konsol hatası, başarısız istek, erişilebilirlik ve kontrast sorunları olmamalı
// - Depolama engelli / bozuk değerli / hareketi azalt modlarında site bozulmamalı
//
// Çalıştır: npm test   (Chrome yolu farklıysa: CHROME_PATH=... npm test)

const { test, before, after } = require('node:test');
const assert = require('node:assert/strict');
const http = require('http');
const fs = require('fs');
const path = require('path');
const puppeteer = require('puppeteer-core');

const ROOT = path.join(__dirname, '..');

const BROWSER_CANDIDATES = [
    process.env.CHROME_PATH,
    'C:/Program Files/Google/Chrome/Application/chrome.exe',
    'C:/Program Files (x86)/Microsoft/Edge/Application/msedge.exe',
    '/usr/bin/google-chrome',
    '/usr/bin/chromium',
    '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome'
].filter(Boolean);

const MIME = {
    '.html': 'text/html; charset=utf-8',
    '.css': 'text/css; charset=utf-8',
    '.js': 'text/javascript; charset=utf-8',
    '.jpg': 'image/jpeg',
    '.png': 'image/png',
    '.pdf': 'application/pdf',
    '.ico': 'image/x-icon'
};

let server;
let browser;
let baseUrl;

// Yalnızca proje klasöründeki dosyaları sunan küçük statik sunucu
function startServer() {
    return new Promise((resolve) => {
        server = http.createServer((req, res) => {
            let urlPath;
            try {
                urlPath = decodeURIComponent(new URL(req.url, 'http://x').pathname);
            } catch {
                res.writeHead(400).end();
                return;
            }
            if (urlPath.endsWith('/')) urlPath += 'index.html';
            const filePath = path.normalize(path.join(ROOT, urlPath));
            if (!filePath.startsWith(ROOT + path.sep) || !fs.existsSync(filePath) || fs.statSync(filePath).isDirectory()) {
                res.writeHead(404).end('not found');
                return;
            }
            res.writeHead(200, { 'Content-Type': MIME[path.extname(filePath)] || 'application/octet-stream' });
            fs.createReadStream(filePath).pipe(res);
        });
        server.listen(0, '127.0.0.1', () => {
            baseUrl = `http://127.0.0.1:${server.address().port}`;
            resolve();
        });
    });
}

before(async () => {
    await startServer();
    const executablePath = BROWSER_CANDIDATES.find((p) => fs.existsSync(p));
    assert.ok(executablePath, 'Chrome veya Edge bulunamadı (CHROME_PATH ile belirtin)');
    browser = await puppeteer.launch({ executablePath, headless: true, args: ['--no-sandbox'] });
});

after(async () => {
    if (browser) await browser.close();
    if (server) server.close();
});

const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

// Sayfayı açar; konsol hatalarını ve başarısız istekleri toplar
async function openPage({ width = 1280, height = 800, theme, lang, mobile = false, reducedMotion = false, blockStorage = false, storage } = {}) {
    // Her sayfa ayrı (gizli) oturumda açılır: testler birbirinin depolamasını görmez
    const context = await browser.createBrowserContext();
    const page = await context.newPage();
    const originalClose = page.close.bind(page);
    page.close = async () => { await originalClose(); await context.close(); };
    const errors = [];
    page.on('pageerror', (e) => errors.push(`pageerror: ${e.message}`));
    page.on('console', (m) => { if (m.type() === 'error') errors.push(`console: ${m.text()}`); });
    page.on('requestfailed', (r) => errors.push(`requestfailed: ${r.url()} ${r.failure()?.errorText}`));
    page.on('response', (r) => { if (r.status() >= 400) errors.push(`HTTP ${r.status()}: ${r.url()}`); });

    await page.setViewport({ width, height, isMobile: mobile, hasTouch: mobile, deviceScaleFactor: 1 });
    if (reducedMotion) await page.emulateMediaFeatures([{ name: 'prefers-reduced-motion', value: 'reduce' }]);

    const initial = { ...(storage || {}) };
    if (theme) initial['portfolio-theme'] = theme;
    if (lang) initial['portfolio-language'] = lang;
    await page.evaluateOnNewDocument((values, block) => {
        if (block) {
            const deny = () => { throw new DOMException('blocked', 'SecurityError'); };
            Object.defineProperty(window, 'localStorage', { get: deny });
            return;
        }
        if (!sessionStorage.getItem('__seeded')) {
            Object.entries(values).forEach(([k, v]) => localStorage.setItem(k, v));
            sessionStorage.setItem('__seeded', '1');
        }
    }, initial, blockStorage);

    await page.goto(`${baseUrl}/index.html`, { waitUntil: 'networkidle0' });
    await page.evaluate(() => document.fonts && document.fonts.ready);
    return { page, errors };
}

// Yatay taşmayı ölçer ve taşan öğeleri listeler
async function horizontalOverflow(page) {
    return page.evaluate(() => {
        window.scrollTo(600, window.scrollY);
        const scrolledX = window.scrollX;
        window.scrollTo(0, window.scrollY);
        const vw = document.documentElement.clientWidth;
        const offenders = [];
        document.querySelectorAll('body *').forEach((el) => {
            const r = el.getBoundingClientRect();
            if (r.width === 0 || r.right <= vw + 1) return;
            // Kırpan bir üst öğe varsa sorun değil
            for (let p = el.parentElement; p && p !== document.body; p = p.parentElement) {
                const o = getComputedStyle(p);
                if (/(hidden|clip)/.test(o.overflowX) && p.getBoundingClientRect().right <= vw + 1) return;
            }
            if (getComputedStyle(el).position === 'fixed') return;
            offenders.push(`${el.tagName.toLowerCase()}.${[...el.classList].join('.')} (sağ kenar ${Math.round(r.right)} > ${vw})`);
        });
        return { scrollWidth: document.documentElement.scrollWidth, vw, scrolledX, offenders: offenders.slice(0, 8) };
    });
}

const WIDTHS = [320, 360, 375, 390, 414, 768, 820, 1024, 1280, 1440, 1920];

test('hiçbir ekran boyutunda yatay kaydırma yok (koyu tema, Türkçe)', async () => {
    for (const width of WIDTHS) {
        const { page, errors } = await openPage({ width, mobile: width < 768 });
        const o = await horizontalOverflow(page);
        assert.equal(o.scrolledX, 0, `${width}px: sayfa yana kaydırılabiliyor. Taşanlar: ${o.offenders.join(', ')}`);
        assert.ok(o.scrollWidth <= o.vw, `${width}px: scrollWidth ${o.scrollWidth} > ${o.vw}`);
        assert.deepEqual(errors, [], `${width}px hataları`);
        await page.close();
    }
});

test('açık temada ve İngilizcede de yatay kaydırma yok', async () => {
    for (const width of [320, 390, 768, 1024, 1440]) {
        const { page, errors } = await openPage({ width, theme: 'light-theme', lang: 'en', mobile: width < 768 });
        const o = await horizontalOverflow(page);
        assert.equal(o.scrolledX, 0, `${width}px açık/EN: taşanlar: ${o.offenders.join(', ')}`);
        assert.equal(await page.evaluate(() => document.body.classList.contains('light-theme')), true);
        assert.equal(await page.evaluate(() => document.documentElement.lang), 'en');
        assert.deepEqual(errors, []);
        await page.close();
    }
});

test('menüdeki her bağlantı var olan bir bölüme gider ve kitap sayfası geçişi tamamlanır', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    const ids = await page.$$eval('#navLinks a[href^="#"]', (as) => as.map((a) => a.getAttribute('href').slice(1)));
    assert.ok(ids.length >= 5);
    for (const id of ids) {
        assert.ok(await page.$(`#${id}`), `#${id} bölümü yok`);
        // Geçişin ortasında katman ekranı kaplamalı
        await page.click(`#navLinks a[href="#${id}"]`);
        await sleep(150);
        assert.equal(await page.$eval('.page-turn', (el) => el.classList.contains('is-active')), true, `#${id}: sayfa katmanı açılmadı`);
        await sleep(1300);
        const state = await page.evaluate((sid) => ({
            active: document.querySelector('.page-turn').classList.contains('is-active'),
            top: Math.round(document.getElementById(sid).getBoundingClientRect().top),
            atBottom: Math.ceil(window.scrollY + window.innerHeight) >= document.documentElement.scrollHeight - 2,
            hash: location.hash,
            focusInside: document.getElementById(sid).contains(document.activeElement)
        }), id);
        assert.equal(state.active, false, `#${id}: katman kapanmadı`);
        // Son bölüm sayfanın sonuna denk geldiği için en üste çıkamayabilir: o zaman sayfa sonunda olmalı
        assert.ok((state.top >= -5 && state.top <= 200) || (state.atBottom && state.top < 800),
            `#${id}: bölüme gidilmedi (top=${state.top})`);
        assert.equal(state.hash, `#${id}`);
        assert.ok(state.focusInside, `#${id}: odak bölüme taşınmadı`);
    }
    assert.deepEqual(errors, []);
    await page.close();
});

test('mobil menü açılır, bağlantı çalışır, Escape ve dışarı tıklama kapatır', async () => {
    const { page, errors } = await openPage({ width: 390, height: 844, mobile: true });
    const toggle = await page.$('#menuToggle');
    const box = await toggle.boundingBox();
    assert.ok(box && box.width >= 44 && box.height >= 44, 'menü düğmesi 44px dokunma alanından küçük');
    for (const id of ['#langToggle', '#themeToggle']) {
        const b = await (await page.$(id)).boundingBox();
        assert.ok(b && b.width >= 44 && b.height >= 44, `${id} 44px dokunma alanından küçük`);
    }

    await page.tap('#menuToggle');
    await sleep(350);
    assert.equal(await page.$eval('#navLinks', (n) => n.classList.contains('active')), true);
    assert.equal(await page.$eval('#menuToggle', (b) => b.getAttribute('aria-expanded')), 'true');

    await page.keyboard.press('Escape');
    assert.equal(await page.$eval('#navLinks', (n) => n.classList.contains('active')), false);

    await page.tap('#menuToggle');
    await sleep(350);
    await page.tap('#navLinks a[href="#projects"]');
    await sleep(1400);
    assert.equal(await page.$eval('#navLinks', (n) => n.classList.contains('active')), false, 'menü bağlantıdan sonra kapanmadı');
    const top = await page.$eval('#projects', (s) => s.getBoundingClientRect().top);
    assert.ok(top >= -5 && top <= 200, `projeler bölümüne gidilmedi (top=${top})`);
    const o = await horizontalOverflow(page);
    assert.equal(o.scrolledX, 0);
    assert.deepEqual(errors, []);
    await page.close();
});

test('dil düğmesi tüm metinleri çevirir ve boş metin bırakmaz', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    assert.equal(await page.$eval('#about-title', (h) => h.textContent.trim()), 'Hakkımda');
    await page.click('#langToggle');
    assert.equal(await page.evaluate(() => document.documentElement.lang), 'en');
    assert.equal(await page.$eval('#about-title', (h) => h.textContent.trim()), 'About Me');
    const empty = await page.$$eval('[data-en][data-tr]', (els) => els.filter((e) => !e.textContent.trim()).length);
    assert.equal(empty, 0, 'boş kalan çeviri var');
    const undef = await page.evaluate(() => document.body.innerText.includes('undefined'));
    assert.equal(undef, false);
    await page.click('#langToggle');
    assert.equal(await page.$eval('#about-title', (h) => h.textContent.trim()), 'Hakkımda');
    assert.deepEqual(errors, []);
    await page.close();
});

test('tema düğmesi çalışır ve tercih yeniden yüklemede yanıp sönmeden korunur', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    assert.equal(await page.evaluate(() => document.body.className), 'dark-theme');
    await page.click('#themeToggle');
    assert.equal(await page.evaluate(() => document.body.classList.contains('light-theme')), true);

    // Yeniden yükle: ilk boyamadan önce açık tema uygulanmış olmalı
    await page.evaluateOnNewDocument(() => {
        document.addEventListener('DOMContentLoaded', () => {
            window.__themeAtDomReady = document.body.className;
        });
    });
    await page.reload({ waitUntil: 'networkidle0' });
    assert.equal(await page.evaluate(() => window.__themeAtDomReady), 'light-theme');
    assert.deepEqual(errors, []);
    await page.close();
});

test('bozuk/kötü niyetli depolama değerleri siteyi bozmaz', async () => {
    const { page, errors } = await openPage({
        width: 1280,
        storage: { 'portfolio-language': '<img src=x onerror=alert(1)>', 'portfolio-theme': 'evil-theme" onload="x' }
    });
    assert.equal(await page.evaluate(() => document.documentElement.lang), 'tr');
    assert.equal(await page.evaluate(() => document.body.className), 'dark-theme');
    assert.equal(await page.evaluate(() => document.body.innerText.includes('undefined')), false);
    assert.equal(await page.$('img[src="x"]'), null);
    assert.deepEqual(errors, []);
    await page.close();
});

test('depolama tamamen engelliyken (gizli mod) site ve düğmeler çalışır', async () => {
    const { page, errors } = await openPage({ width: 390, mobile: true, blockStorage: true });
    await page.tap('#menuToggle');
    await sleep(300);
    assert.equal(await page.$eval('#navLinks', (n) => n.classList.contains('active')), true);
    await page.keyboard.press('Escape');
    await page.tap('#themeToggle');
    assert.equal(await page.evaluate(() => document.body.classList.contains('light-theme')), true);
    await page.tap('#langToggle');
    assert.equal(await page.evaluate(() => document.documentElement.lang), 'en');
    assert.deepEqual(errors, []);
    await page.close();
});

test('hareketi azalt modunda içerik hemen görünür, sayfa geçişi gösterilmez', async () => {
    const { page, errors } = await openPage({ width: 1280, reducedMotion: true });
    const hidden = await page.$$eval('.rise, .thread-entry', (els) => els.filter((e) => getComputedStyle(e).opacity !== '1').length);
    assert.equal(hidden, 0, 'gizli kalan içerik var');
    await page.click('#navLinks a[href="#experience"]');
    await sleep(50);
    assert.equal(await page.$eval('.page-turn', (el) => getComputedStyle(el).display), 'none');
    const top = await page.$eval('#experience', (s) => s.getBoundingClientRect().top);
    assert.ok(top >= -5 && top <= 200);
    assert.deepEqual(errors, []);
    await page.close();
});

test('kaydırınca tüm içerik görünür hale gelir (gizli kalan bölüm yok)', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    const height = await page.evaluate(() => document.body.scrollHeight);
    for (let y = 0; y < height; y += 400) {
        await page.evaluate((yy) => window.scrollTo(0, yy), y);
        await sleep(60);
    }
    await sleep(1600);
    const notShown = await page.$$eval('.rise, .thread-entry', (els) => els.filter((e) => !e.classList.contains('is-in')).length);
    assert.equal(notShown, 0);
    assert.deepEqual(errors, []);
    await page.close();
});

test('erişilebilirlik: görsellerde alt, düğmelerde ad, dış bağlantılarda noopener', async () => {
    const { page } = await openPage({ width: 1280 });
    const report = await page.evaluate(() => ({
        imgNoAlt: [...document.images].filter((i) => !i.getAttribute('alt')).length,
        unnamedButtons: [...document.querySelectorAll('button')].filter((b) => !(b.getAttribute('aria-label') || b.textContent.trim())).length,
        unsafeBlank: [...document.querySelectorAll('a[target="_blank"]')].filter((a) => !/noopener/.test(a.rel)).length,
        httpLinks: [...document.querySelectorAll('a[href^="http:"]')].length,
        positiveTabindex: [...document.querySelectorAll('[tabindex]')].filter((e) => e.tabIndex > 0).length,
        duplicateIds: (() => { const ids = [...document.querySelectorAll('[id]')].map((e) => e.id); return ids.length - new Set(ids).size; })()
    }));
    assert.deepEqual(report, { imgNoAlt: 0, unnamedButtons: 0, unsafeBlank: 0, httpLinks: 0, positiveTabindex: 0, duplicateIds: 0 });
    await page.close();
});

test('metin kontrastı iki temada da WCAG AA (4.5:1) üstünde', async () => {
    for (const theme of ['dark-theme', 'light-theme']) {
        const { page } = await openPage({ width: 1280, theme });
        const results = await page.evaluate(() => {
            const css = getComputedStyle(document.body);
            const hex = (name) => css.getPropertyValue(name).trim();
            const toRgb = (h) => { const n = parseInt(h.slice(1), 16); return [(n >> 16) & 255, (n >> 8) & 255, n & 255]; };
            const lum = (rgb) => { const c = rgb.map((v) => { v /= 255; return v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4; }); return 0.2126 * c[0] + 0.7152 * c[1] + 0.0722 * c[2]; };
            const ratio = (a, b) => { const [x, y] = [lum(toRgb(a)), lum(toRgb(b))].sort((m, n) => n - m); return (x + 0.05) / (y + 0.05); };
            const out = [];
            for (const fg of ['--s-ink', '--s-muted', '--s-faint', '--s-blue', '--s-purple', '--s-green']) {
                for (const bg of ['--s-bg', '--s-surface', '--s-surface-2']) {
                    out.push({ pair: `${fg} / ${bg}`, ratio: +ratio(hex(fg), hex(bg)).toFixed(2) });
                }
            }
            return out;
        });
        const failing = results.filter((r) => r.ratio < 4.5);
        assert.deepEqual(failing, [], `${theme}: düşük kontrast`);
        await page.close();
    }
});

// Ekrandaki gerçek öğelerin yazı rengini, üst üste binen gerçek arka planlarla
// (yarı saydam katmanlar dahil) karşılaştırır.
async function measureContrast(page, selectors) {
    return page.evaluate((sels) => {
        const parse = (c) => { const m = c.match(/rgba?\(([^)]+)\)/); if (!m) return null; const p = m[1].split(',').map((x) => parseFloat(x)); return { r: p[0], g: p[1], b: p[2], a: p.length > 3 ? p[3] : 1 }; };
        const over = (top, bottom) => ({ r: top.r * top.a + bottom.r * (1 - top.a), g: top.g * top.a + bottom.g * (1 - top.a), b: top.b * top.a + bottom.b * (1 - top.a), a: 1 });
        const lum = (c) => { const f = (v) => { v /= 255; return v <= 0.03928 ? v / 12.92 : ((v + 0.055) / 1.055) ** 2.4; }; return 0.2126 * f(c.r) + 0.7152 * f(c.g) + 0.0722 * f(c.b); };
        const pageBg = parse(getComputedStyle(document.body).backgroundColor) || { r: 255, g: 255, b: 255, a: 1 };
        function effectiveBg(el) {
            const layers = [];
            for (let n = el; n && n !== document.documentElement; n = n.parentElement) {
                const c = parse(getComputedStyle(n).backgroundColor);
                if (c && c.a > 0) { layers.push(c); if (c.a >= 1) break; }
            }
            let bg = { ...pageBg, a: 1 };
            for (let i = layers.length - 1; i >= 0; i--) bg = over(layers[i], bg);
            return bg;
        }
        const out = [];
        sels.forEach((sel) => {
            document.querySelectorAll(sel).forEach((el, i) => {
                if (i > 2) return;
                const r = el.getBoundingClientRect();
                if (!r.width || !r.height || getComputedStyle(el).visibility === 'hidden') return;
                const fg = parse(getComputedStyle(el).color);
                const bg = effectiveBg(el);
                const fgc = fg.a < 1 ? over(fg, bg) : fg;
                const [l1, l2] = [lum(fgc), lum(bg)].sort((x, y) => y - x);
                out.push({ sel, ratio: +((l1 + 0.05) / (l2 + 0.05)).toFixed(2) });
            });
        });
        return out;
    }, selectors);
}

const TEXT_SELECTORS = ['#navLinks a', '.brand', '.tool-label', '.sec-title', '.about-text p', '.status-pill span:not(.status-dot)', '.fact-row dd',
    '.stack-name', '.chip span', '.entry-role', '.entry-org', '.entry-date', '.entry-points li', '.tag',
    '.work-title', '.work-category', '.work-desc', '.work-badge', '.work-link', '.cert-name', '.cert-issuer',
    '.contact-lead', '.contact-mail span', '.pill-btn:not(.pill-btn-accent) span', '.footer-row p', '.footer-row a'];

test('ekrandaki gerçek metinlerin kontrastı iki temada da AA (4.5:1)', async () => {
    for (const theme of ['dark-theme', 'light-theme']) {
        for (const [width, mobile] of [[1280, false], [390, true]]) {
            const { page } = await openPage({ width, mobile, theme });
            await page.evaluate(() => document.querySelectorAll('.rise,.thread-entry,[data-thread]').forEach((e) => e.classList.add('is-in', 'is-drawn', 'is-done')));
            if (mobile) { await page.tap('#menuToggle'); await sleep(400); }
            await sleep(800);
            const results = await measureContrast(page, TEXT_SELECTORS);
            const failing = results.filter((r) => r.ratio < 4.5);
            assert.deepEqual(failing, [], `${theme} ${width}px: düşük kontrast`);
            await page.close();
        }
    }
});

test('CV indirilebilir ve PDF olarak sunuluyor', async () => {
    const { page } = await openPage({ width: 1280 });
    const href = await page.$eval('a[download]', (a) => a.getAttribute('href'));
    const res = await page.evaluate(async (h) => {
        const r = await fetch(h);
        const buf = new Uint8Array(await r.arrayBuffer());
        return { status: r.status, type: r.headers.get('content-type'), magic: String.fromCharCode(...buf.slice(0, 5)) };
    }, href);
    assert.equal(res.status, 200);
    assert.equal(res.magic, '%PDF-');
    await page.close();
});

test('imleç efekti: masaüstünde çalışır, tıklamayı engellemez; dokunmatik ve hareketi azaltta yok', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    await page.mouse.move(400, 300);
    await page.mouse.move(420, 320, { steps: 5 });
    await sleep(300);
    const desk = await page.evaluate(() => {
        const dot = document.querySelector('.cursor-dot');
        const ring = document.querySelector('.cursor-ring');
        return {
            exists: Boolean(dot && ring),
            on: document.documentElement.classList.contains('cursor-on'),
            pe: dot && getComputedStyle(dot).pointerEvents + '/' + getComputedStyle(ring).pointerEvents
        };
    });
    assert.deepEqual(desk, { exists: true, on: true, pe: 'none/none' });
    // Bağlantının üzerine gelince halka "hover" durumuna geçer ve tıklama yine çalışır
    const link = await page.$('#navLinks a[href="#about"]');
    const box = await link.boundingBox();
    await page.mouse.move(box.x + box.width / 2, box.y + box.height / 2, { steps: 4 });
    assert.equal(await page.evaluate(() => document.documentElement.classList.contains('cursor-hover')), true);
    await page.mouse.click(box.x + box.width / 2, box.y + box.height / 2);
    await sleep(1300);
    assert.equal(await page.evaluate(() => location.hash), '#about');
    assert.deepEqual(errors, []);
    await page.close();

    for (const opts of [{ width: 390, mobile: true }, { width: 1280, reducedMotion: true }]) {
        const { page: p2 } = await openPage(opts);
        assert.equal(await p2.$('.cursor-dot'), null, `imleç efekti oluşmamalıydı: ${JSON.stringify(opts)}`);
        await p2.close();
    }
});

test('hero: isim erişilebilir; kart çekilir, bırakınca geri sarılır, boşta sallanmaz; hareketi azaltta sabit', async () => {
    const { page, errors } = await openPage({ width: 1440, height: 900 });
    const nameInfo = await page.$eval('.hero-name', (h) => ({
        label: h.getAttribute('aria-label'),
        letters: h.querySelectorAll('.ch').length
    }));
    assert.equal(nameInfo.label, 'Ayşe Nur Kendirci');
    assert.equal(nameInfo.letters, 15);

    const pull = () => page.$eval('.badge-rig', (r) => ({
        y: parseFloat(r.style.getPropertyValue('--pull')) || 0,
        lean: parseFloat(r.style.getPropertyValue('--lean')) || 0
    }));

    // Açılıştan sonra kart tamamen durmalı (sallanma yok)
    await sleep(3000);
    const a = await pull();
    await sleep(700);
    const b = await pull();
    assert.ok(Math.abs(a.y) < 0.5 && Math.abs(b.y) < 0.5 && a.lean === b.lean, `kart boşta hareket ediyor: ${JSON.stringify([a, b])}`);

    // Aşağı çek: şerit uzar, lastik sınırı aşılmaz
    const card = await page.$('.portfolio-card');
    const box = await card.boundingBox();
    const cx = box.x + box.width / 2;
    const cy = box.y + box.height * 0.6;
    await page.mouse.move(cx, cy);
    await page.mouse.down();
    await page.mouse.move(cx + 40, cy + 400, { steps: 15 });
    const pulled = await pull();
    assert.ok(pulled.y > 100 && pulled.y <= 170, `kart aşağı çekilmedi ya da sınır aşıldı (y=${pulled.y})`);
    assert.ok(pulled.lean < 0, 'sağa çekince kart sağa yatmadı');
    await page.mouse.up();

    // Bırakınca yaylanarak yerine döner ve durur
    await sleep(2500);
    const back = await pull();
    assert.ok(Math.abs(back.y) < 0.5 && Math.abs(back.lean) < 0.05, `kart yerine dönmedi: ${JSON.stringify(back)}`);
    assert.equal(await page.$eval('[data-badge]', (w) => w.classList.contains('has-pulled')), true, 'ipucu gizlenmedi');

    // Yerinde tıklama: kart kendiliğinden çekilip bırakılır
    await page.mouse.click(cx, cy);
    await sleep(120);
    assert.ok((await pull()).y > 5, 'tıklayınca kart çekilmedi');
    assert.deepEqual(errors, []);
    await page.close();

    // Dokunmatik: dokununca çekilir
    const { page: touch } = await openPage({ width: 390, height: 844, mobile: true });
    await sleep(2500);
    await touch.$eval('.portfolio-card', (c) => c.scrollIntoView({ block: 'center', behavior: 'instant' }));
    await sleep(200);
    await touch.tap('.portfolio-card');
    await sleep(120);
    assert.ok((await touch.$eval('.badge-rig', (r) => parseFloat(r.style.getPropertyValue('--pull')) || 0)) > 5, 'dokununca kart çekilmedi');
    await touch.close();

    const { page: still } = await openPage({ width: 1440, height: 900, reducedMotion: true });
    await sleep(600);
    const transform = await still.$eval('.badge-rig', (r) => getComputedStyle(r).transform);
    assert.ok(transform === 'none' || transform === 'matrix(1, 0, 0, 1, 0, 0)', `hareketi azaltta kart hareketli: ${transform}`);
    assert.equal(await still.$eval('.pull-hint', (h) => getComputedStyle(h).display), 'none');
    await still.close();
});

test('favicon yüklenir ve sitede sarı/altın renk kullanılmaz', async () => {
    const { page, errors } = await openPage({ width: 1280 });
    const icon = await page.$eval('link[rel="icon"]', (l) => l.href);
    const res = await page.evaluate(async (h) => { const r = await fetch(h); return { status: r.status, text: await r.text() }; }, icon);
    assert.equal(res.status, 200);
    assert.match(res.text, /<svg/);
    // Kartın ve klipslerin hesaplanan renklerinde altın tonu kalmamalı
    const golds = await page.evaluate(() => {
        const goldish = /rgb\((2[0-5]\d|1[89]\d), (1[5-9]\d|2[0-3]\d), (\d{1,2}|1[0-3]\d)\)/;
        const out = [];
        document.querySelectorAll('.portfolio-card, .clip, .lanyard-clip, .pill-btn').forEach((el) => {
            const cs = getComputedStyle(el);
            const bg = cs.backgroundImage + ' ' + cs.backgroundColor;
            if (goldish.test(bg)) out.push(el.className);
        });
        return out;
    });
    assert.deepEqual(golds, [], 'altın/sarı renk kalmış');
    assert.deepEqual(errors, []);
    await page.close();
});

test('hero her masaüstü ekranında ilk ekrana sığar ve aynı oranda görünür', async () => {
    const ratios = [];
    for (const [width, height] of [[1280, 720], [1366, 768], [1536, 734], [1440, 900], [1920, 1080], [2560, 1440]]) {
        const { page, errors } = await openPage({ width, height });
        await sleep(2600);
        const m = await page.evaluate(() => {
            const bottom = (s) => document.querySelector(s).getBoundingClientRect().bottom;
            return {
                social: bottom('.hero-social-icons'),
                card: bottom('.portfolio-card'),
                hint: bottom('.pull-hint'),
                name: parseFloat(getComputedStyle(document.querySelector('.hero-name')).fontSize)
            };
        });
        for (const [part, b] of Object.entries({ sosyal: m.social, kart: m.card, ipucu: m.hint })) {
            assert.ok(b <= height, `${width}x${height}: ${part} ilk ekrana sığmıyor (alt=${Math.round(b)})`);
        }
        // İsim, ekranın dar kenarına göre hep aynı oranda olmalı
        ratios.push(m.name / Math.min(width, height * 1.55));
        assert.deepEqual(errors, []);
        await page.close();
    }
    const spread = Math.max(...ratios) / Math.min(...ratios);
    assert.ok(spread < 1.05, `ekranlar arasında oran farkı çok büyük: ${ratios.map((r) => r.toFixed(4)).join(', ')}`);
});

test('mobil navbar tek satırda ve kompakt', async () => {
    for (const width of [320, 360, 390, 414, 768]) {
        const { page } = await openPage({ width, height: 800, mobile: true });
        const m = await page.evaluate(() => {
            const top = (s) => Math.round(document.querySelector(s).getBoundingClientRect().top);
            return {
                height: Math.round(document.querySelector('.site-header').getBoundingClientRect().height),
                brand: top('.brand'), tools: top('#langToggle'), menu: top('#menuToggle'),
                brandText: document.querySelector('.brand').innerText.replace(/\s+/g, ' ').trim(),
                brandCut: document.querySelector('.brand-line').scrollWidth > document.querySelector('.brand').clientWidth + 1
            };
        });
        assert.ok(m.height <= 70, `${width}px: navbar çok yüksek (${m.height}px)`);
        assert.ok(Math.abs(m.menu - m.tools) < 12 && Math.abs(m.menu - m.brand) < 20, `${width}px: navbar tek satırda değil ${JSON.stringify(m)}`);
        assert.match(m.brandText, /Ayşe Nur Kendirci/);
        assert.equal(m.brandCut, false, `${width}px: navbar'daki isim kesiliyor`);
        await page.close();
    }
});

test('sayfa yüklenirken kayma yok (CLS < 0.1, yavaş bağlantıda bile)', async () => {
    for (const [width, height, mobile] of [[1440, 900, false], [1536, 734, false], [390, 844, true]]) {
        const context = await browser.createBrowserContext();
        const page = await context.newPage();
        await page.setViewport({ width, height, isMobile: mobile, hasTouch: mobile });
        const cdp = await page.createCDPSession();
        await cdp.send('Network.emulateNetworkConditions', {
            offline: false, latency: 150, downloadThroughput: 400 * 1024, uploadThroughput: 200 * 1024
        });
        await page.evaluateOnNewDocument(() => {
            window.__cls = 0;
            new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) if (!entry.hadRecentInput) window.__cls += entry.value;
            }).observe({ type: 'layout-shift', buffered: true });
        });
        await page.goto(`${baseUrl}/index.html`, { waitUntil: 'networkidle0', timeout: 60000 });
        await sleep(2500);
        const cls = await page.evaluate(() => window.__cls);
        assert.ok(cls < 0.1, `${width}x${height}: yükleme sırasında kayma çok fazla (CLS=${cls.toFixed(3)})`);
        await context.close();
    }
});

test('e-posta: telefonda kartın dışına taşmaz; tıklayınca yazma ekranı açılır; kopyalanabilir', async () => {
    // Taşma: adres her telefon genişliğinde iletişim kartının içinde kalmalı
    for (const width of [320, 360, 375, 390, 414]) {
        const { page } = await openPage({ width, height: 800, mobile: true });
        const m = await page.evaluate(() => {
            const card = document.querySelector('.contact-inner').getBoundingClientRect();
            const mail = document.querySelector('.contact-mail span').getBoundingClientRect();
            const copy = document.querySelector('.copy-mail').getBoundingClientRect();
            const fs = parseFloat(getComputedStyle(document.querySelector('.contact-mail')).fontSize);
            return { cardL: card.left, cardR: card.right, mailL: mail.left, mailR: mail.right, copyR: copy.right,
                oneLine: mail.height < fs * 2.6 }; // tek satır ≈ 1.9×, iki satır ≥ 3.4×
        });
        assert.ok(m.oneLine, `${width}px: e-posta adresi iki satıra bölünüyor`);
        assert.ok(m.mailR <= m.cardR - 8 && m.mailL >= m.cardL && m.copyR <= m.cardR - 8,
            `${width}px: e-posta kartın dışına taşıyor ${JSON.stringify(m)}`);
        await page.close();
    }

    // Masaüstü: Gmail yazma ekranı yeni sekmede, alıcı ve konu dolu
    const { page, errors } = await openPage({ width: 1280 });
    await page.evaluate(() => document.getElementById('contact').scrollIntoView({ behavior: 'instant' }));
    await page.evaluate(() => document.querySelectorAll('.rise').forEach((e) => e.classList.add('is-in', 'is-done')));
    // window.open çağrısını yakala (Gmail oturum açılmamış tarayıcıyı girişe yönlendirir)
    await page.evaluate(() => {
        window.__opened = [];
        window.open = (u, name, features) => { window.__opened.push({ u, name, features }); return null; };
    });
    await page.click('.contact-mail');
    const opened = await page.evaluate(() => window.__opened);
    assert.equal(opened.length, 1, 'yazma ekranı açılmadı');
    const url = new URL(opened[0].u);
    assert.equal(url.hostname, 'mail.google.com');
    assert.equal(url.searchParams.get('view'), 'cm');
    assert.equal(url.searchParams.get('to'), 'aysenurkendirciss@gmail.com');
    assert.equal(url.searchParams.get('su'), 'Portfolyo üzerinden iletişim');
    assert.equal(opened[0].name, '_blank');
    assert.match(opened[0].features, /noopener/);

    // Kopyala düğmesi
    await page.browserContext().overridePermissions(baseUrl, ['clipboard-read', 'clipboard-write', 'clipboard-sanitized-write']);
    await page.click('.copy-mail');
    await sleep(150);
    assert.equal(await page.evaluate(() => navigator.clipboard.readText()), 'aysenurkendirciss@gmail.com');
    assert.equal(await page.$eval('.copy-mail span', (s) => s.textContent), 'Kopyalandı');
    assert.deepEqual(errors, []);
    await page.close();

    // Telefon: cihazın e-posta uygulaması için mailto, konu ile
    const { page: phone } = await openPage({ width: 390, height: 844, mobile: true });
    await phone.evaluate(() => {
        const link = document.querySelector('.contact-mail');
        link.addEventListener('click', (e) => e.preventDefault(), { once: true }); // testte uygulamayı açma
        link.click();
    });
    const href = await phone.$eval('.contact-mail', (a) => a.getAttribute('href'));
    assert.equal(href, 'mailto:aysenurkendirciss@gmail.com?subject=Portfolyo%20%C3%BCzerinden%20ileti%C5%9Fim');
    await phone.close();
});
