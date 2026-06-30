# Netlify Deployment Validation Script (Windows PowerShell)
# Run this to verify your site is ready for Netlify deployment

Write-Host "Netlify Deployment Validation" -ForegroundColor Cyan
Write-Host "=================================" -ForegroundColor Cyan
Write-Host ""

$issues = 0

# Check 1: Essential files
Write-Host "Checking essential files..." -ForegroundColor Yellow
$files = @("index.html", "netlify.toml", ".gitignore")

foreach ($file in $files) {
    if (Test-Path $file) {
        Write-Host "OK: $file exists" -ForegroundColor Green
    } else {
        Write-Host "ERROR: $file missing" -ForegroundColor Red
        $issues++
    }
}

Write-Host ""

# Check 2: Directories
Write-Host "Checking directories..." -ForegroundColor Yellow
$dirs = @("css", "js", "images", "includes")

foreach ($dir in $dirs) {
    if (Test-Path $dir -PathType Container) {
        Write-Host "OK: $dir/ exists" -ForegroundColor Green
    } else {
        Write-Host "ERROR: $dir/ missing" -ForegroundColor Red
        $issues++
    }
}

Write-Host ""

# Check 3: CSS files
Write-Host "Checking CSS files..." -ForegroundColor Yellow
$cssFiles = @("css/style.css", "css/base.css", "css/content.css", "css/hero.css", "css/navbar.css")

foreach ($file in $cssFiles) {
    if (Test-Path $file) {
        Write-Host "OK: $file exists" -ForegroundColor Green
    } else {
        Write-Host "WARNING: $file missing (might be optional)" -ForegroundColor Yellow
    }
}

Write-Host ""

# Check 4: JavaScript files
Write-Host "Checking JavaScript files..." -ForegroundColor Yellow
if (Test-Path "js/script.js") {
    Write-Host "OK: js/script.js exists" -ForegroundColor Green
} else {
    Write-Host "ERROR: js/script.js missing" -ForegroundColor Red
    $issues++
}

Write-Host ""

# Check 5: Images
Write-Host "Checking critical images..." -ForegroundColor Yellow
if (Test-Path "images/profile.jpg") {
    Write-Host "OK: images/profile.jpg exists" -ForegroundColor Green
} else {
    Write-Host "WARNING: images/profile.jpg missing" -ForegroundColor Yellow
}

Write-Host ""

# Check 6: Formspree configuration
Write-Host "Checking form configuration..." -ForegroundColor Yellow
$htmlContent = Get-Content index.html -Raw
if ($htmlContent -match "REPLACE_WITH_YOUR_FORMSPREE_ID") {
    Write-Host "WARNING: Formspree ID not configured yet" -ForegroundColor Yellow
    Write-Host "   >> Update: https://formspree.io/f/YOUR_ID in index.html" -ForegroundColor Gray
} elseif ($htmlContent -match "formspree.io") {
    Write-Host "OK: Formspree configured" -ForegroundColor Green
}

Write-Host ""

# Check 7: Git status
Write-Host "Checking git repository..." -ForegroundColor Yellow
if (Test-Path ".git" -PathType Container) {
    Write-Host "OK: Git repository initialized" -ForegroundColor Green
    
    $gitStatus = & git status --porcelain 2>$null
    if ($gitStatus) {
        Write-Host "WARNING: Uncommitted changes detected" -ForegroundColor Yellow
        Write-Host "   >> Run: git add . && git commit -m 'Prepare for Netlify deployment'" -ForegroundColor Gray
    } else {
        Write-Host "OK: All changes committed" -ForegroundColor Green
    }
} else {
    Write-Host "ERROR: Not a git repository" -ForegroundColor Red
    Write-Host "   >> Initialize: git init && git add . && git commit -m 'Initial commit'" -ForegroundColor Gray
    $issues++
}

Write-Host ""

# Check 8: netlify.toml validation
Write-Host "Checking netlify.toml..." -ForegroundColor Yellow
$tomlContent = Get-Content netlify.toml -Raw

if ($tomlContent -match 'command = ""') {
    Write-Host "OK: Build command set to empty (correct for static site)" -ForegroundColor Green
} else {
    Write-Host "WARNING: Build command might be incorrect" -ForegroundColor Yellow
}

if ($tomlContent -match 'publish = "/"') {
    Write-Host "OK: Publish directory set to / (root)" -ForegroundColor Green
} else {
    Write-Host "WARNING: Publish directory might be incorrect" -ForegroundColor Yellow
}

Write-Host ""

# Summary
Write-Host "=================================" -ForegroundColor Cyan
if ($issues -eq 0) {
    Write-Host "All checks passed!" -ForegroundColor Green
    Write-Host "Your site is ready for Netlify deployment." -ForegroundColor Green
    Write-Host ""
    Write-Host "Next steps:" -ForegroundColor Cyan
    Write-Host "1. Update Formspree form ID (if not done)" -ForegroundColor Gray
    Write-Host "2. Commit changes: git push origin main" -ForegroundColor Gray
    Write-Host "3. Deploy: Go to netlify.com, Add new site, Connect GitHub" -ForegroundColor Gray
} else {
    Write-Host "ERRORS: $issues issue(s) found" -ForegroundColor Red
    Write-Host "Please fix the above issues before deploying." -ForegroundColor Red
}

Write-Host ""
