<?php
require_once 'includes/db.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty & Officer Login - ITSO Student Link</title>
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
            <form class="login-form" id="login-form" method="post" action="includes/login.inc.php">
                <h2>ITSO STUDENT LINK</h2>
                <h3>Faculty Login</h3>
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Enter Username" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <input type="hidden" name="user-type" value="faculty">
                <input type="hidden" name="login_type" value="<?php echo isset($_SESSION['form_data']['login_type']) ? $_SESSION['form_data']['login_type'] : 'faculty'; ?>">
                
                <button type="submit" name="submit" >Login</button>
                <div class="links">
                    <a href="forgotpassword.php" class="forgot-password">Forgot Password?</a>
                    <a href="faculty_signup.php" class="create-account">Create a Faculty Account</a>
                </div>
            </form>

            <?php 
            check_login_errors();            
            ?>
        </div>
    </div>
   
</body>
</html>