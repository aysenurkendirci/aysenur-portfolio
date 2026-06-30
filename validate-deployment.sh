#!/bin/bash
# Netlify Deployment Validation Script

echo "🔍 Netlify Deployment Validation"
echo "================================="
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Counter for issues
ISSUES=0

# Check 1: Essential files
echo "Checking essential files..."
FILES=("index.html" "netlify.toml" ".gitignore")

for file in "${FILES[@]}"; do
    if [ -f "$file" ]; then
        echo -e "${GREEN}✓${NC} $file exists"
    else
        echo -e "${RED}✗${NC} $file missing"
        ((ISSUES++))
    fi
done

echo ""

# Check 2: Directories
echo "Checking directories..."
DIRS=("css" "js" "images" "includes")

for dir in "${DIRS[@]}"; do
    if [ -d "$dir" ]; then
        echo -e "${GREEN}✓${NC} $dir/ exists"
    else
        echo -e "${RED}✗${NC} $dir/ missing"
        ((ISSUES++))
    fi
done

echo ""

# Check 3: CSS files
echo "Checking CSS files..."
CSS_FILES=("css/style.css" "css/base.css" "css/content.css" "css/hero.css" "css/navbar.css")

for file in "${CSS_FILES[@]}"; do
    if [ -f "$file" ]; then
        echo -e "${GREEN}✓${NC} $file exists"
    else
        echo -e "${YELLOW}⚠${NC} $file missing (might be optional)"
    fi
done

echo ""

# Check 4: JavaScript files
echo "Checking JavaScript files..."
if [ -f "js/script.js" ]; then
    echo -e "${GREEN}✓${NC} js/script.js exists"
else
    echo -e "${RED}✗${NC} js/script.js missing"
    ((ISSUES++))
fi

echo ""

# Check 5: Images
echo "Checking critical images..."
if [ -f "images/profile.jpg" ]; then
    echo -e "${GREEN}✓${NC} images/profile.jpg exists"
else
    echo -e "${YELLOW}⚠${NC} images/profile.jpg missing"
fi

echo ""

# Check 6: Formspree configuration
echo "Checking form configuration..."
if grep -q "REPLACE_WITH_YOUR_FORMSPREE_ID" index.html; then
    echo -e "${YELLOW}⚠${NC} Formspree ID not configured yet"
    echo "   → Update: https://formspree.io/f/YOUR_ID in index.html line 1301"
else
    if grep -q "formspree.io" index.html; then
        echo -e "${GREEN}✓${NC} Formspree configured"
    fi
fi

echo ""

# Check 7: Git status
echo "Checking git repository..."
if [ -d ".git" ]; then
    echo -e "${GREEN}✓${NC} Git repository initialized"
    if git status --porcelain | grep -q .; then
        echo -e "${YELLOW}⚠${NC} Uncommitted changes detected"
        echo "   → Run: git add . && git commit -m 'Prepare for Netlify deployment'"
    else
        echo -e "${GREEN}✓${NC} All changes committed"
    fi
else
    echo -e "${RED}✗${NC} Not a git repository"
    ((ISSUES++))
fi

echo ""

# Check 8: netlify.toml validation
echo "Checking netlify.toml..."
if grep -q 'command = ""' netlify.toml; then
    echo -e "${GREEN}✓${NC} Build command set to empty (correct for static site)"
else
    echo -e "${YELLOW}⚠${NC} Build command might be incorrect"
fi

if grep -q 'publish = "/"' netlify.toml; then
    echo -e "${GREEN}✓${NC} Publish directory set to / (root)"
else
    echo -e "${YELLOW}⚠${NC} Publish directory might be incorrect"
fi

echo ""

# Summary
echo "================================="
if [ $ISSUES -eq 0 ]; then
    echo -e "${GREEN}✓ All checks passed!${NC}"
    echo "Your site is ready for Netlify deployment."
    echo ""
    echo "Next steps:"
    echo "1. Update Formspree form ID (if not done)"
    echo "2. Commit changes: git push origin main"
    echo "3. Deploy: Go to netlify.com → Add new site → Connect GitHub"
else
    echo -e "${RED}✗ $ISSUES issue(s) found${NC}"
    echo "Please fix the above issues before deploying."
fi

echo ""
