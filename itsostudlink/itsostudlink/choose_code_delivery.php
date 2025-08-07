<?php
// Get email and contact from query or previous POST
$email = isset($_GET['email']) ? $_GET['email'] : '';
$contact = isset($_GET['contact']) ? $_GET['contact'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_method'])) {
    $method = $_POST['send_method'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    // Redirect to verification page with method, email, and contact
    header('Location: verify_code.php?method=' . urlencode($method) . '&email=' . urlencode($email) . '&contact=' . urlencode($contact));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Code Delivery</title>
    <link rel="stylesheet" href="styles/styles-forgotpassword.css">
</head>
<body>
    <div class="forgot-password-container">
        <h2>Choose Code Delivery</h2>
        <form method="POST" action="">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
            <label>
                <input type="radio" name="send_method" value="email" required> Send code to Email (<?php echo htmlspecialchars($email); ?>)
            </label>
            <br><br>
            <label>
                <input type="radio" name="send_method" value="contact" required> Send code to Contact Number (<?php echo htmlspecialchars($contact); ?>)
            </label>
            <br><br>
            <button type="submit">Continue</button>
        </form>
        <a href="forgotpassword.php">Back</a>
    </div>
</body>
</html>
