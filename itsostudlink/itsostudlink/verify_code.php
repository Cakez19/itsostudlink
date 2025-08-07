<?php
// Get method, email, and contact from query
$method = isset($_GET['method']) ? $_GET['method'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$contact = isset($_GET['contact']) ? $_GET['contact'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verification_code'])) {
    $entered_code = $_POST['verification_code'];
    // Here you would check the code against what was sent
    // For now, just redirect to a reset password page (or show success)
    header('Location: reset_password.php?email=' . urlencode($email));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Verification Code</title>
    <link rel="stylesheet" href="styles/styles-forgotpassword.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Enter Verification Code</h2>
        <p>Enter the code <?php echo $method === 'email' ? 'email' : 'contact number'; ?>.</p>
        <form method="POST" action="">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
            <input type="text" name="verification_code" placeholder="Enter code here" required>
            <button type="submit">Verify</button>
        </form>
        <a href="choose_code_delivery.php?email=<?php echo urlencode($email); ?>&contact=<?php echo urlencode($contact); ?>">Back</a>
    </div>
</body>
</html>
