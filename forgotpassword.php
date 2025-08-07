<?php
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? ''; 
    $contact = $_POST["contact"] ?? '';
    $message = "If your email is registered, you will receive password reset instructions.";
 
    header("Location: choose_code_delivery.php?email=" . urlencode($email) . "&contact=" . urlencode($contact));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles/styles-forgotpassword.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form method="POST" action="">
            <input type="text" name="email" id="email" placeholder="Email Address" required>
            <input type="text" name="contact" id="contact" placeholder="Contact Number" required>
            <button type="submit">Send code</button>
        </form>
        <a href="index.php">Back to Login</a>
    </div>
</body>
</html>
