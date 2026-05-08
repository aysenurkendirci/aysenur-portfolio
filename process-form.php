<?php
/*
    PROCESS FORM PAGE
    Contact formundan gelen verileri kontrol eder.
    Form doğrulama sonucuna göre kullanıcıya başarı veya hata mesajı gösterir.
*/

include 'data.php';

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$name = '';
$email = '';
$message = '';
$isSuccess = false;

$errorMessageEn = '';
$errorMessageTr = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $errorMessageEn = 'Please fill in all required fields.';
        $errorMessageTr = 'Lütfen zorunlu alanların tamamını doldurun.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessageEn = 'Please enter a valid email address.';
        $errorMessageTr = 'Lütfen geçerli bir e-posta adresi girin.';
    } else {
        $isSuccess = true;
    }
} else {
    $errorMessageEn = 'This page can only be accessed after submitting the contact form.';
    $errorMessageTr = 'Bu sayfaya yalnızca iletişim formu gönderildikten sonra erişilebilir.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Result | Ayşe Nur Kendirci</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark-theme">
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

    <?php include 'includes/navbar.php'; ?>

    <main>
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

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>