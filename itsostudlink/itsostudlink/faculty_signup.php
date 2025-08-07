<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Sign Up - ITSO Student Link</title>
    <link rel="stylesheet" href="styles/styles-signup.css">
    <style>
        .input-group .error-message {
            color: #D8000C; /* Red for errors */
            background-color: #FFD2D2; /* Light red background */
            border-radius: 3px;
            padding: 5px 10px;
            font-size: 0.8em;
            margin-top: 5px;
            display: none; /* Hidden by default */
        }
    </style>
</head>
<body>
<div class="login-container">

        <div class="logo-section">
            <div class="university-logo">
                <div class="logo-circle">
                    <div class="logo-content">
                     <img src="img/logo.png" alt="logo">
                    </div>
                </div>
            </div>
        </div>
        <form class="login-form" id="signup-form" action="includes/faculty_signup.inc.php" method="post">
            <h2>Create Faculty Account</h2>
            <div class="input-group">
                <label for="faculty_num">Faculty Number</label>
                <input type="text" id="faculty_num" name="faculty_num">
                <div class="error-message" id="faculty_num-error"></div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <div class="error-message" id="email-error"></div>
            </div>
            <div class="input-group">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact">
                <div class="error-message" id="contact-error"></div>
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <div class="error-message" id="username-error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="error-message" id="password-error"></div>
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="conpwd" name="conpwd">
                <div class="error-message" id="conpwd-error"></div>
            </div>
            <button type="submit" name="submit">Sign Up</button>
            <p class="message">Already registered? <a href="login.php">Sign In</a></p>
        </form>
        <?php
        check_signup_errors();
        ?>
    </div>
    <script src="script/script-signup.js"></script>
</body>
</html>
