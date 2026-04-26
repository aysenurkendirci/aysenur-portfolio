<?php
/*
    Formdan gelen veriler için başlangıç değişkenleri tanımlanır.
    Başta boş bırakılır çünkü kullanıcı form göndermeden bu sayfaya gelmiş olabilir.
*/
$name = "";
$email = "";
$message = "";
$success = false;
$error = "";

/*
    Formun gerçekten POST yöntemiyle gönderilip gönderilmediği kontrol edilir.
    Böylece sayfa direkt açılırsa gereksiz işlem yapılmaz.
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
        $_POST ile formdan gelen değerler alınır.
        ?? "" kullanımı, değer gelmezse hata oluşmasını engeller.
        trim() ise baştaki ve sondaki boşlukları temizler.
    */
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    /*
        Kullanıcı herhangi bir alanı boş bıraktıysa hata mesajı verilir.
    */
    if ($name === "" || $email === "" || $message === "") {
        $error = "Please fill in all fields.";

    /*
        Email formatı doğru değilse kullanıcı uyarılır.
    */
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    /*
        Bütün kontroller geçilirse form başarılı kabul edilir.
        Bu projede gerçek mail gönderimi yapılmıyor, sadece başarı mesajı gösteriliyor.
    */
    } else {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Türkçe karakterlerin ve özel sembollerin doğru görünmesi için UTF-8 kullanılır -->
    <meta charset="UTF-8">

    <!-- Sayfanın mobil cihazlarda düzgün görünmesi için viewport ayarı yapılır -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tarayıcı sekmesinde görünen sayfa başlığı -->
    <title>Contact Result</title>

    <!-- Projenin ortak CSS dosyası bağlanır -->
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- Sayfa varsayılan olarak koyu tema ile açılır -->
<body class="dark-theme">

    <!-- 
        main etiketi sayfanın ana içeriğini temsil eder.
        Semantic HTML açısından doğru bir kullanımdır.
    -->
    <main class="section">
        <div class="container">

            <!-- 
                Form sonucunu gösteren kart yapısı.
                contact-form class'ı mevcut form tasarımını tekrar kullanır.
                result-box class'ı sadece bu sayfaya özel hizalama için eklenmiştir.
            -->
            <div class="contact-form result-box">

                <!-- Eğer form başarıyla gönderildiyse başarı mesajı gösterilir -->
                <?php if ($success): ?>

                    <h1 class="result-title">Message Sent Successfully</h1>

                    <p class="result-text">
                        Thank you,
                        <strong><?= htmlspecialchars($name); ?></strong>.
                    </p>

                    <p class="result-text">
                        Your message has been received.
                    </p>

                    <p class="result-text result-text-last">
                        We will contact you via
                        <strong><?= htmlspecialchars($email); ?></strong>
                        if needed.
                    </p>

                    <a href="index.php" class="btn">Back to Portfolio</a>

                <!-- Eğer hata varsa hata mesajı gösterilir -->
                <?php else: ?>

                    <h1 class="result-title">Form Error</h1>

                    <p class="result-text result-text-last">
                        <?= htmlspecialchars($error ?: "Something went wrong."); ?>
                    </p>

                    <a href="index.php#contact" class="btn">Go Back</a>

                <?php endif; ?>

            </div>
        </div>
    </main>
</body>
</html>