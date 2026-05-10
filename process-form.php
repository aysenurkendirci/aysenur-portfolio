<?php
/**
 * Contact Form Processing Page
 * 
 * This file processes contact form submissions from the main portfolio page.
 * It validates the form data and displays a success or error message.
 * 
 * Features:
 * - Input validation (name, email, message)
 * - Email format validation
 * - Security: HTML escaping to prevent XSS attacks
 * - Bilingual support (English/Turkish)
 * - Proper HTTP method checking
 */

include 'data.php';

/**
 * Security function to escape output
 * Prevents XSS attacks by converting special characters to HTML entities
 * 
 * @param string $value The value to escape
 * @return string Escaped value safe for HTML output
 */
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Initialize form variables
$name = '';
$email = '';
$message = '';
$isSuccess = false;

$errorMessageEn = '';
$errorMessageTr = '';

// Process form only on POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim input
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate required fields
    if ($name === '' || $email === '' || $message === '') {
        $errorMessageEn = 'Please fill in all required fields.';
        $errorMessageTr = 'Lütfen zorunlu alanların tamamını doldurun.';
    } 
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessageEn = 'Please enter a valid email address.';
        $errorMessageTr = 'Lütfen geçerli bir e-posta adresi girin.';
    } 
    // Form is valid
    else {
        $isSuccess = true;
        
        // TODO: Add email sending functionality here
        // Example: mail($profile["email"], "Portfolio Contact Form", "From: $email\n\n$message");
    }
} else {
    // Handle non-POST access
    $errorMessageEn = 'This page can only be accessed after submitting the contact form.';
    $errorMessageTr = 'Bu sayfaya yalnızca iletişim formu gönderildikten sonra erişilebilir.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character encoding for proper text rendering -->
    <meta charset="UTF-8">
    
    <!-- Viewport settings for responsive design on all devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Page title for browser tab -->
    <title>Contact Result | Ayşe Nur Kendirci</title>

    <!-- Font Awesome icons library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Dev icons library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <!-- Decorative cursor glow effect (visual enhancement) -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Include navigation bar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main content area -->
    <main>
        <!-- Contact Result Section: Displays success or error message -->
        <section class="contact-result-section section" aria-labelledby="result-title">
            <div class="container">
                <article class="result-card">
                    <?php if ($isSuccess): ?>
                        <div class="result-icon success-icon" aria-hidden="true">
                            <i class="fa-solid fa-check"></i>
                        </div>

                        <h1 id="result-title"
                            class="result-title"
                            data-en="Message Received"
                            data-tr="Mesaj Alındı">
                            Message Received
                        </h1>

                        <p class="result-text"
                           data-en="Thank you, <?= e($name); ?>. Your message has been received successfully."
                           data-tr="Teşekkürler, <?= e($name); ?>. Mesajınız başarıyla alındı.">
                            Thank you, <?= e($name); ?>. Your message has been received successfully.
                        </p>

                        <p class="result-text"
                           data-en="I will review your message and get back to you as soon as possible."
                           data-tr="Mesajınızı inceleyip en kısa sürede size dönüş yapacağım.">
                            I will review your message and get back to you as soon as possible.
                        </p>
                    <?php else: ?>
                        <div class="result-icon error-icon" aria-hidden="true">
                            <i class="fa-solid fa-xmark"></i>
                        </div>

                        <h1 id="result-title"
                            class="result-title"
                            data-en="Message Could Not Be Sent"
                            data-tr="Mesaj Gönderilemedi">
                            Message Could Not Be Sent
                        </h1>

                        <p class="result-text"
                           data-en="<?= e($errorMessageEn); ?>"
                           data-tr="<?= e($errorMessageTr); ?>">
                            <?= e($errorMessageEn); ?>
                        </p>
                    <?php endif; ?>

                    <a href="index.php#contact"
                       class="btn result-button"
                       data-en="Back to Contact"
                       data-tr="İletişime Geri Dön">
                        Back to Contact
                    </a>
                </article>
            </div>
        </section>
    </main>

    <!-- Include footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Language preference loader script -->
    <script>
        /**
         * Language Preference Handler
         * Loads the persisted language preference from localStorage on page load
         */
        (function() {
            const savedLanguage = localStorage.getItem('portfolio-language');
            const initialLanguage = savedLanguage || 'en';
            
            document.documentElement.lang = initialLanguage;
            window.__initialLanguage = initialLanguage;
        })();
    </script>
    
    <!-- Main interaction script -->
    <script src="js/script.js"></script>
</body>
</html>