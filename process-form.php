<?php
include 'data.php';
/**
 * Güvenlik Fonksiyonu: Çıkışı Kaçış Karakteri ile İşle
 * XSS saldırılarını önler - özel karakterleri HTML entitylerine dönüştürür
 * 
 * @param string $value Kaçış işlemi yapılacak değer
 * @return string HTML çıkış için güvenli kaçışlı değer
*/
/*Kullanıcıdan gelen verileri direkt ekrana basmadım. XSS saldırılarını önlemek için htmlspecialchars kullanan e() fonksiyonu oluşturdum. Bu fonksiyon, özel karakterleri HTML entitylerine dönüştürerek zararlı kodların çalışmasını engeller. Formdan gelen verileri ekrana basarken e() fonksiyonunu kullanarak güvenliği sağlıyorum.*/
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

/**
 * Validates the contact form data.
 *
 * @param string $name The submitted name.
 * @param string $email The submitted email address.
 * @param string $message The submitted message.
 * @param string|null &$errorMessageEn Reference to English error message variable.
 * @param string|null &$errorMessageTr Reference to Turkish error message variable.
 * @return bool True if validation passes, false otherwise.
 */
function validateFormData(string $name, string $email, string $message, ?string &$errorMessageEn, ?string &$errorMessageTr): bool
{
    if ($name === '' || $email === '' || $message === '') {
        $errorMessageEn = 'Please fill in all required fields.';
        $errorMessageTr = 'Lütfen zorunlu alanların tamamını doldurun.';
        error_log('Form Validation Error: Missing required fields.');
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessageEn = 'Please enter a valid email address.';
        $errorMessageTr = 'Lütfen geçerli bir e-posta adresi girin.';
        error_log('Form Validation Error: Invalid email format provided.');
        return false;
    }

    return true;
}

// Process form only on POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim input data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate form data using the helper function
    if (validateFormData($name, $email, $message, $errorMessageEn, $errorMessageTr)) {
        $isSuccess = true;
        
        // TODO: Email sending functionality will be added here.
        // Example: mail($profile["email"], "Portfolio Contact Form", "Sender: $email\n\n$message");
        
        // E-posta gönderme işlevselliği
        $to = $profile["email"]; // data.php'den alınan e-posta adresi
        $subject = "Portfolio Contact Form - Yeni Mesaj"; // E-posta konusu
        $body = "Gönderen: " . e($name) . " <" . e($email) . ">\n\n";
        $body .= "Mesaj:\n" . e($message);
        
        // Ek başlıklar
        $headers = "From: " . e($name) . " <" . e($email) . ">\r\n";
        $headers .= "Reply-To: " . e($email) . "\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        // E-postayı gönderme
        if (!mail($to, $subject, $body, $headers)) {
            // E-posta gönderme başarısız olursa
            $isSuccess = false;
            $errorMessageEn = 'Failed to send your message. Please try again later.';
            $errorMessageTr = 'Mesajınız gönderilemedi. Lütfen daha sonra tekrar deneyin.';
            error_log('Email sending failed for: ' . $email);
        }
    }
} else {
    // Error message for non-POST access
    $errorMessageEn = 'This page can only be accessed after submitting the contact form.';
    $errorMessageTr = 'Bu sayfaya yalnızca iletişim formu gönderildikten sonra erişilebilir.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metin Kodlaması: Doğru metin görüntülenmesi için -->
    <meta charset="UTF-8">
    
    <!-- Responsive Tasarım: Tüm cihazlarda uygun görünüm -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Sayfa Başlığı: Tarayıcı sekmesi -->
    <title>İletişim Sonucu | Ayşe Nur Kendirci</title>

    <!-- Font Awesome İkon Kütüphanesi: UI ikonları -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Dev İkonları Kütüphanesi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <!-- Ana Stil Dosyası: Tüm CSS stilleri -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <a href="#main-content" class="sr-only" tabindex="1">
        <span data-en="Skip to main content" data-tr="Ana içeriğe atla">
            Skip to main content
        </span>
    </a>

    <!-- Dekoratif İmleç Parıltı Efekti (görsel iyileştirme) -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Navigasyon Çubuğunu Dahil Et -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Ana İçerik Alanı -->
    <main id="main-content">
        <!-- İletişim Sonucu Bölümü: Başarı veya hata mesajı gösterir -->
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

    <!-- Altbilgi (Footer) Dahil Et -->
    <?php include 'includes/footer.php'; ?>

    <!-- Dil Tercihi Yükleyici Betiği -->
    <script>
        /**
         * Dil Tercihi İşleyicisi
         * Sayfa yüklenirken localStorage'dan kalıcı dil tercihini yükler
         */
        (function() {
            const savedLanguage = localStorage.getItem('portfolio-language');
            const initialLanguage = savedLanguage || 'en';
            
            document.documentElement.lang = initialLanguage;
            window.__initialLanguage = initialLanguage;
        })();
    </script>
    
    <!-- Ana Etkileşim Betiği -->
    <script src="js/script.js"></script>
</body>
</html>