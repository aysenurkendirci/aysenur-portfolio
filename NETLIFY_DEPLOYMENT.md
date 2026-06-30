# Netlify Deployment Guide - Ayşe Nur Kendirci Portfolio

## Prerequisites
- GitHub account with repository access
- Netlify account (free tier is sufficient)

## Step-by-Step Deployment

### 1. **Prepare Your Repository**
```bash
# Make sure all changes are committed
git status
git add .
git commit -m "Prepare for Netlify deployment"
git push origin main
```

### 2. **Connect to Netlify**

#### Option A: Using Netlify UI
1. Go to [netlify.com](https://netlify.com)
2. Click "Sign up" or "Sign in" with your GitHub account
3. Click "Add new site" → "Import an existing project"
4. Select GitHub and authorize Netlify
5. Choose your repository
6. Confirm build settings:
   - **Build command**: Leave empty (static site)
   - **Publish directory**: `/` (root)
7. Click "Deploy site"

#### Option B: Using Netlify CLI
```bash
# Install Netlify CLI
npm install -g netlify-cli

# Login to Netlify
netlify login

# Deploy your site
netlify deploy --prod
```

### 3. **Configure Contact Form**

#### Using Formspree (Current Setup)
1. Visit [formspree.io](https://formspree.io)
2. Sign up or log in
3. Create a new form with your email address
4. You'll receive a form ID (e.g., `f/abc123xyz`)
5. Update the form action in `index.html` line 1301:
   ```html
   action="https://formspree.io/f/YOUR_FORM_ID"
   ```
6. Replace `YOUR_FORM_ID` with your actual form ID
7. Test the form on your live site

#### Alternative: Using Netlify Forms
1. Add `netlify` attribute to form in `index.html`:
   ```html
   <form class="contact-form" netlify name="contact">
   ```
2. Netlify will automatically capture form submissions
3. View submissions in Netlify Dashboard → Forms tab

### 4. **Verify Deployment**

After deployment:
- ✅ Check if site loads at your Netlify URL
- ✅ Test all navigation links
- ✅ Test contact form submission
- ✅ Verify images load correctly
- ✅ Test responsive design on mobile
- ✅ Check console for any errors (F12)

### 5. **Custom Domain (Optional)**

1. In Netlify Dashboard → Site settings → Domain management
2. Click "Add custom domain"
3. Enter your domain name
4. Follow DNS configuration instructions
5. Wait for DNS propagation (24-48 hours typically)

### 6. **SSL Certificate**

Netlify automatically provides free SSL certificates via Let's Encrypt:
- Automatic HTTPS is enabled by default
- Certificate auto-renews annually
- Redirects HTTP to HTTPS automatically

### 7. **Optimize Performance**

Current configuration includes:
- ✅ Asset caching (CSS, JS, images cached for 1 year)
- ✅ HTML cache with short TTL (1 hour) for updates
- ✅ Security headers enabled
- ✅ HSTS enabled
- ✅ XSS and Clickjacking protection

### 8. **Monitor Your Site**

In Netlify Dashboard:
- **Analytics** - View site traffic and performance
- **Forms** - Monitor contact form submissions (if using Netlify Forms)
- **Deploys** - Check deployment history
- **Functions** - Monitor serverless functions (if added later)

## Troubleshooting

### Site shows 404
- Check if `publish` directory is set to `/` in netlify.toml
- Verify index.html exists in root directory
- Clear browser cache (Ctrl+Shift+Delete)

### Form not submitting
- Verify form action URL is correct
- Check browser console for errors (F12)
- Test with valid email format
- Check spam folder for Formspree confirmation emails

### Images not loading
- Verify image paths use relative URLs (e.g., `images/profile.jpg`)
- Check file permissions
- Ensure image files are in repository (not in .gitignore)

### Style/JS files not loading
- Check file paths are relative
- Verify CSS and JS files are in git repository
- Check browser console for 404 errors

## Important Files

- **index.html** - Main portfolio page (entry point)
- **netlify.toml** - Netlify configuration
- **.gitignore** - Excludes PHP files from deployment
- **css/style.css** - Main stylesheet
- **js/script.js** - Main JavaScript file
- **images/** - All portfolio images

## What's NOT Deployed

The following are intentionally excluded from deployment (see .gitignore):
- ❌ `index.php` - PHP not supported on Netlify static hosting
- ❌ `process-form.php` - Replaced with Formspree/Netlify Forms
- ❌ `data.php` - Data moved to index.html JavaScript
- ❌ `includes/` - PHP includes no longer needed

## Environment Variables

Add secrets in Netlify Dashboard → Site settings → Build & deploy → Environment:
- API keys should never be in code
- Use Netlify environment variables instead

## Further Customization

### Add redirects
Edit netlify.toml to add custom redirects (already configured for SPA)

### Add functions
Create serverless functions in `netlify/functions/` for backend logic

### Add plugins
Use Netlify Build plugins for additional functionality

---

**Next Step:** Push your code to GitHub and follow the deployment steps above! 🚀
