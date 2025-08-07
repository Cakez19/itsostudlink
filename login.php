<?php
require_once 'includes/db.php';
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
        <div class="form-section"><h2>ITSO STUDENT LINK</h2>
            <div id="role-selection">
                
                <h2 class="role-prompt">Select Your Role</h2>
                <div class="role-selection-container">
                    <a href="student_login.php" class="role-card" id="student-role">
                        <div class="role-icon">🎓</div>
                        <div class="role-title">Student</div>
                    </a>
                    <a href="faculty_login.php" class="role-card" id="faculty-role">
                        <div class="role-icon">💼</div>
                        <div class="role-title">Faculty</div>
                    </a>
                    <a href="admin_login.php" class="role-card" id="admin-role">
                        <div class="role-icon">👑</div>
                        <div class="role-title">Admin</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>