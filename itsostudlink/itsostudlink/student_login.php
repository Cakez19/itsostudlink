<?php

require_once 'includes/db.php';
require_once 'includes/login_view.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ITSO Student Link</title>
    <link rel="stylesheet" href="styles/styles-login.css">
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
        <div class="form-section">
            <form class="login-form" id="login-form" action="includes/login.inc.php" method="post" autocomplete="on">
                <h2>ITSO STUDENT LINK</h2>
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Enter Username" >
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" >
                </div>
                <input type="hidden" name="user-type" value="student">
                <input type="hidden" name="login_type" value="<?php echo isset($_SESSION['form_data']['login_type']) ? $_SESSION['form_data']['login_type'] : 'student'; ?>">
                <button type="submit">Login</button>
                <div class="links">
                    <a href="forgotpassword.php" class="forgot-password">Forgot Password?</a>
                    <a href="signup.php" class="create-account">Create an Account</a>
                    <?php check_login_errors();?>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>
