<?php
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST["code"] ?? '';
    // Here you would add logic to verify the code entered by the user.
    // If code is valid, redirect to reset password page
    header("Location: reset_password.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enter Code</title>
    <link rel="stylesheet" href="styles\styles-entercode.css">
  
</head>
<body>
    <div class="code-container">
        <h2>Enter Verification Code</h2>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form method="POST" action="">
            <label for="code">Type the code sent to your email:</label>
            <input type="text" name="code" id="code" required>
            <button type="submit">Next</button>
        </form>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>
