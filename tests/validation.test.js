// Birim testleri: data.json doğrulaması ve şablon kaçışı.
// Çalıştır: npm test

const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('fs');
const path = require('path');

const { validateData } = require('../scripts/validate-data');
const { escapeHtml, renderTemplate } = require('../build');

const ROOT = path.join(__dirname, '..');
const loadData = () => JSON.parse(fs.readFileSync(path.join(ROOT, 'src', 'data.json'), 'utf8'));

function problemsAfter(mutate) {
    const data = loadData();
    mutate(data);
    return validateData(data, ROOT);
}

test('mevcut data.json geçerli', () => {
    assert.deepEqual(validateData(loadData(), ROOT), []);
});

test('telefon numarası yakalanır', () => {
    for (const phone of ['+90 533 394 55 10', '0533 394 55 10', '533-394-55-10', '+905333945510']) {
        const problems = problemsAfter((d) => { d.aboutTexts[0].tr += ` Tel: ${phone}`; });
        assert.ok(problems.some((p) => p.includes('telefon')), `yakalanmadı: ${phone}`);
    }
});

test('HTML ve şablon enjeksiyonu yakalanır', () => {
    for (const bad of ['<script>alert(1)</script>', '<img src=x onerror=alert(1)>', '{{PROFILE_EMAIL}}', 'javascript:alert(1)']) {
        const problems = problemsAfter((d) => { d.projects[0].description.en = bad; });
        assert.ok(problems.some((p) => p.includes('HTML')), `yakalanmadı: ${bad}`);
    }
});

test('güvensiz linkler reddedilir', () => {
    for (const url of ['http://github.com/x', 'https://evil.example.com/x', 'javascript:alert(1)', 'https://user:pass@github.com/x', 'not a url']) {
        const problems = problemsAfter((d) => { d.projects[0].github = url; });
        assert.ok(problems.length > 0, `kabul edildi: ${url}`);
    }
});

test('eksik çeviri yakalanır', () => {
    const problems = problemsAfter((d) => { d.experiences[0].title.tr = ''; });
    assert.ok(problems.some((p) => p.startsWith('experiences[0].title')));
});

test('dosya yolu kaçışı ve olmayan dosya reddedilir', () => {
    assert.ok(problemsAfter((d) => { d.profile.cv = '../../secret.pdf'; }).length > 0);
    assert.ok(problemsAfter((d) => { d.profile.cv = 'images/yok.pdf'; }).length > 0);
    assert.ok(problemsAfter((d) => { d.profile.cv = 'https://evil.example.com/cv.pdf'; }).length > 0);
});

test('geçersiz e-posta ve ikon sınıfı reddedilir', () => {
    assert.ok(problemsAfter((d) => { d.profile.email = 'not-an-email'; }).length > 0);
    assert.ok(problemsAfter((d) => { d.projects[0].icon = 'fa" onmouseover="alert(1)'; }).length > 0);
});

test('aynı proje başlığı iki kez kullanılamaz', () => {
    const problems = problemsAfter((d) => { d.projects[1].title = d.projects[0].title; });
    assert.ok(problems.some((p) => p.includes('aynı başlık')));
});

test('escapeHtml tüm tehlikeli karakterleri kaçırır', () => {
    assert.equal(escapeHtml(`<a href="x" onclick='y'>&{{z}}</a>`),
        '&lt;a href=&quot;x&quot; onclick=&#39;y&#39;&gt;&amp;&#123;&#123;z&#125;&#125;&lt;/a&gt;');
});

test('şablon, veriyi tekrar şablon olarak işlemez ve özniteliklerden taşırmaz', () => {
    const html = renderTemplate('<p title="{{x}}">{{x}}</p>{{#each list}}<i>{{name}}</i>{{/each}}', {
        x: '"><script>alert(1)</script>{{secret}}',
        secret: 'SIZDI',
        list: [{ name: '{{secret}}<b>' }]
    });
    assert.ok(!html.includes('<script>'));
    assert.ok(!html.includes('SIZDI'));
    assert.ok(!html.includes('<b>'));
    assert.match(html, /^<p title="&quot;&gt;/);
});

test('üretilen index.html güvenli ve eksiksiz', () => {
    const html = fs.readFileSync(path.join(ROOT, 'index.html'), 'utf8');
    assert.ok(!/\{\{[^}]*\}\}/.test(html), 'çözülmemiş şablon değişkeni var');
    assert.ok(!/<script(?![^>]*\bsrc=)[^>]*>/i.test(html), 'satır içi script var (CSP ihlali)');
    assert.ok(!/\son[a-z]+\s*=/i.test(html), 'satır içi olay işleyicisi (onclick vb.) var');
    assert.ok(!/unsafe-eval/.test(html), "CSP 'unsafe-eval' içeriyor");
    assert.match(html, /http-equiv="Content-Security-Policy"/);
    assert.ok(!/533\s*394|394\s*55\s*10/.test(html), 'telefon numarası sayfada');
    // Tüm dış kaynaklar sabit sürümlü ve SRI ile yükleniyor (Google Fonts hariç: SRI desteklemez)
    const cdnLinks = (html.match(/<link[^>]+href="https:\/\/cdn[^"]+"[^>]*>/g) || [])
        .filter((tag) => /rel="stylesheet"/.test(tag));
    assert.ok(cdnLinks.length >= 2);
    cdnLinks.forEach((tag) => {
        assert.match(tag, /integrity="sha384-/, `SRI yok: ${tag}`);
        assert.ok(!tag.includes('@latest'), `sabitlenmemiş sürüm: ${tag}`);
    });
});
