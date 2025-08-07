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
    <title>Sign Up - ITSO Student Link</title>
    <link rel="stylesheet" href="styles/styles-signup.css">
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
        <form class="login-form" id="signup-form" action="includes/signup.inc.php" method="post">
            <h2>Create Account</h2>
            <div class="input-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname">
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname">
            </div>
            <div class="input-group">
                <label for="studentnum">Student Number</label>
                <input type="text" id="studentnum" name="studentnum">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="input-group">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact">
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="input-group2">
            <select name="year_level" id="year_level">
                        
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                    <label for="section">Section:</label>
                    <select name="section" id="section">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="conpwd" name="conpwd">
            </div>
            <button type="submit" name="submit">Sign Up</button>
            <p >Already registered? <a href="login.php">Sign In</a></p>
            <div class="error-message">
       <p> <?php check_signup_errors();?></p> 
       </div>
        </form>
       
    </div>
    <script src="script/script-signup.js"></script>
</body>
</html>
