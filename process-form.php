<?php
/**
 * İletişim Formu İşleme Sayfası
 * 
 * Bu dosya ana portföy sayfasından gelen iletişim formu gönderilerini işler.
 * Form verilerini doğrular ve başarı veya hata mesajı gösterir.
 * 
 * Özellikler:
 * - Girdi doğrulaması (ad, e-posta, mesaj)
 * - E-posta biçimi doğrulaması
 * - Güvenlik: XSS saldırılarını önlemek için HTML kaçış karakteri
 * - Çok dilli destek (İngilizce/Türkçe)
 * - Uygun HTTP yöntem kontrolü
 */

include 'data.php';

/**
 * Güvenlik Fonksiyonu: Çıkışı Kaçış Karakteri ile İşle
 * XSS saldırılarını önler - özel karakterleri HTML entitylerine dönüştürür
 * 
 * @param string $value Kaçış işlemi yapılacak değer
 * @return string HTML çıkış için güvenli kaçışlı değer
 */
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Form değişkenlerini başlat
$name = '';
$email = '';
$message = '';
$isSuccess = false;

$errorMessageEn = '';
$errorMessageTr = '';

// Formu sadece POST isteği üzerinde işle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Girdiyi temizle ve boşlukları kaldır
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Zorunlu alanları doğrula
    if ($name === '' || $email === '' || $message === '') {
        $errorMessageEn = 'Please fill in all required fields.';
        $errorMessageTr = 'Lütfen zorunlu alanların tamamını doldurun.';
    } 
    // E-posta biçimini doğrula
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessageEn = 'Please enter a valid email address.';
        $errorMessageTr = 'Lütfen geçerli bir e-posta adresi girin.';
    } 
    // Form geçerliyse
    else {
        $isSuccess = true;
        
        // TODO: E-posta gönderme işlevi burayı ekleyin
        // Örnek: mail($profile["email"], "Portföy İletişim Formu", "Gönderen: $email\n\n$message");
    }
} else {
    // POST olmayan erişim için hata mesajı
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
    <!-- Dekoratif İmleç Parıltı Efekti (görsel iyileştirme) -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Navigasyon Çubuğunu Dahil Et -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Ana İçerik Alanı -->
    <main>
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