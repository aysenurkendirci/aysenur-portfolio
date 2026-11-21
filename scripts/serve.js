// Local preview server: serves the project folder at http://127.0.0.1:5500
// Usage: npm run preview   (PORT=8080 npm run preview to change the port)
// Only files inside the project are served; path traversal is rejected.

const http = require('http');
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');
const PORT = Number(process.env.PORT) || 5500;
const BLOCKED = ['node_modules', '.git', 'src', 'scripts', 'tests'];

const MIME = {
    '.html': 'text/html; charset=utf-8',
    '.css': 'text/css; charset=utf-8',
    '.js': 'text/javascript; charset=utf-8',
    '.json': 'application/json; charset=utf-8',
    '.svg': 'image/svg+xml',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.png': 'image/png',
    '.webp': 'image/webp',
    '.pdf': 'application/pdf',
    '.ico': 'image/x-icon'
};

http.createServer((req, res) => {
    let urlPath;
    try {
        urlPath = decodeURIComponent(new URL(req.url, 'http://localhost').pathname);
    } catch {
        res.writeHead(400).end('Bad request');
        return;
    }
    if (urlPath.endsWith('/')) urlPath += 'index.html';

    const filePath = path.normalize(path.join(ROOT, urlPath));
    const relative = path.relative(ROOT, filePath);
    const topLevel = relative.split(path.sep)[0];

    if (relative.startsWith('..') || path.isAbsolute(relative) || BLOCKED.includes(topLevel)
        || !fs.existsSync(filePath) || fs.statSync(filePath).isDirectory()) {
        res.writeHead(404, { 'Content-Type': 'text/plain; charset=utf-8' }).end('Not found');
        return;
    }

    res.writeHead(200, {
        'Content-Type': MIME[path.extname(filePath).toLowerCase()] || 'application/octet-stream',
        'X-Content-Type-Options': 'nosniff'
    });
    fs.createReadStream(filePath).pipe(res);
}).listen(PORT, '127.0.0.1', () => {
    console.log(`Preview: http://127.0.0.1:${PORT}`);
});
