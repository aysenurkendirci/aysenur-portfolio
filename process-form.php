<?php
/*
    PROCESS FORM PAGE
    Bu dosya contact formundan gelen verileri kontrol eder.
    Amaç:
    - Formun POST yöntemiyle gönderilip gönderilmediğini kontrol etmek
    - Kullanıcıdan gelen name, email ve message alanlarını doğrulamak
    - Güvenli çıktı üretmek
    - Kullanıcıya başarı veya hata sonucu göstermek
*/

include 'data.php';

/*
    e() fonksiyonu dinamik verileri HTML içine güvenli şekilde yazdırır.
    Böylece özel karakterler sayfa yapısını bozmaz.
*/
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/*
    Başlangıç değişkenleri.
    Form gönderilmeden sayfa açılırsa varsayılan olarak hata gösterilir.
*/
$name = '';
$email = '';
$message = '';
$isSuccess = false;
$errorMessage = '';

/*
    Formun yalnızca POST yöntemiyle çalışmasını sağlar.
    Bu, form sayfası için daha doğru ve kontrollü bir yapıdır.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    /*
        Form doğrulama kontrolleri.
        Boş alanlar ve hatalı e-posta formatı kontrol edilir.
    */
    if ($name === '' || $email === '' || $message === '') {
        $errorMessage = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        /*
            Bu projede gerçek mail gönderimi yerine başarılı form sonucu gösterilir.
            İstenirse burada mail() fonksiyonu veya veritabanı kaydı eklenebilir.
        */
        $isSuccess = true;
    }
} else {
    $errorMessage = 'This page can only be accessed after submitting the contact form.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Türkçe karakterlerin doğru görünmesi için UTF-8 kullanılır. -->
    <meta charset="UTF-8">

    <!-- Mobil cihazlarda responsive görünüm için gereklidir. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tarayıcı sekmesinde görünen başlık. -->
    <title>Contact Result | Ayşe Nur Kendirci</title>

    <!-- Font Awesome ikonları sonuç kartındaki ikon için kullanılır. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Devicon navbar veya diğer ortak alanlarda ikon gerekirse uyum için eklenmiştir. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Ana CSS dosyası. -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <!-- Dekoratif mouse ışık efekti. Ekran okuyucular için gizlenir. -->
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <!-- Ortak navbar dosyası. -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- CONTACT RESULT SECTION -->
        <section class="contact-result-section section" aria-labelledby="result-title">
            <div class="container">
                <article class="result-card">
                    <?php if ($isSuccess): ?>
                        <div class="result-icon success-icon" aria-hidden="true">
                            <i class="fa-solid fa-check"></i>
                        </div>

                        <h1 id="result-title" class="result-title">
                            Message Received
                        </h1>

                        <p class="result-text">
                            Thank you, <?= e($name); ?>. Your message has been received successfully.
                        </p>

                        <p class="result-text">
                            I will review your message and get back to you as soon as possible.
                        </p>
                    <?php else: ?>
                        <div class="result-icon error-icon" aria-hidden="true">
                            <i class="fa-solid fa-xmark"></i>
                        </div>

                        <h1 id="result-title" class="result-title">
                            Message Could Not Be Sent
                        </h1>

                        <p class="result-text">
                            <?= e($errorMessage); ?>
                        </p>
                    <?php endif; ?>

                    <a href="index.php#contact" class="btn result-button">
                        Back to Contact
                    </a>
                </article>
            </div>
        </section>
    </main>

    <!-- Ortak footer dosyası. -->
    <?php include 'includes/footer.php'; ?>

    <!-- Ortak JavaScript dosyası. -->
    <script src="js/script.js"></script>
</body>
</html>