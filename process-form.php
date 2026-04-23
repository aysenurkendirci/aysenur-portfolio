<?php
$name = "";
$email = "";
$message = "";
$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dark-theme">
    <main class="section">
        <div class="container">
            <div class="contact-form" style="max-width: 700px; text-align: center;">
                <?php if ($success): ?>
                    <h1 style="margin-bottom: 20px;">Message Sent Successfully</h1>
                    <p style="margin-bottom: 12px;">Thank you, <strong><?= htmlspecialchars($name); ?></strong>.</p>
                    <p style="margin-bottom: 12px;">Your message has been received.</p>
                    <p style="margin-bottom: 24px;">We will contact you via <strong><?= htmlspecialchars($email); ?></strong> if needed.</p>
                    <a href="index.php" class="btn">Back to Portfolio</a>
                <?php else: ?>
                    <h1 style="margin-bottom: 20px;">Form Error</h1>
                    <p style="margin-bottom: 24px;"><?= htmlspecialchars($error ?: "Something went wrong."); ?></p>
                    <a href="index.php#contact" class="btn">Go Back</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>