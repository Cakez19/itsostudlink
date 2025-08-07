<?php
require_once 'includes/db.php';
require_once 'includes/hash_password.php';

function update_password($pdo, $email, $new_password) {
    $tables = ['student', 'faculty', 'admin'];
    foreach ($tables as $table) {
        $query = "SELECT * FROM {$table} WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = hash_password($new_password);
            $update_query = "UPDATE {$table} SET password = :password WHERE email = :email";
                        $update_stmt = $pdo->prepare($update_query);
            $update_stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
            $update_stmt->bindValue(':email', $email, PDO::PARAM_STR);
            return $update_stmt->execute();
        }
    }
    return false;
}

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['email'] ?? '';
    $new_password = $_POST["new_password"] ?? '';
    $confirm_password = $_POST["confirm_password"] ?? '';

    if ($new_password === $confirm_password && !empty($new_password)) {
        if (update_password($pdo, $email, $new_password)) {
            $message = "Your password has been changed successfully.";
        } else {
            $message = "An error occurred. Please try again.";
        }
    } else {
        $message = "Passwords do not match. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles/styles-login.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a4c93, #8b5cf6, #a855f7);
            font-family: 'Arial', 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .reset-container {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            padding: 50px 28px;
            text-align: center;
        }
        h2 {
            color: #6a4c93;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-size: 15px;
        }
        input[type="password"] {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            font-size: 16px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            outline: none;
            margin-bottom: 18px;
        }
        input[type="password"]:focus {
            border-color: #8b5cf6;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6a4c93, #8b5cf6);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
        }
        a {
            display: block;
            margin-top: 18px;
            color: #8b5cf6;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #6a4c93;
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .reset-container {
                padding: 30px 10px;
            }
            h2 {
                font-size: 24px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password</h2>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form method="POST" action="">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="submit">Change Password</button>
        </form>
        <a href="login.php">Back to Login</a>
    </div>
</body>
</html>
