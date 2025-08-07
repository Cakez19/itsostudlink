<?php

require_once '../includes/config_session.inc.php';
require_once '../includes/db.php';
require_once '../includes/school_year.inc.php';

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}

$username = $_SESSION['user_username'];

// Get current school year
$query = "SELECT * FROM school_year WHERE is_active = 1";
$school_year = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

require '../temp/facnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard - ITSO Student Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles-faculty.css"> 
</head>
<body>

        <main class="dashboard-content">
            <header class="dashboard-header">
                <h3 class="welcome-message">Welcome, <?= htmlspecialchars(strtoupper($username)) ?>!</h3>
                <h3 class="school-year">S.Y.: <?= htmlspecialchars($school_year['school_year']) ?></h3>
            </header>
            <h2 class="page-title">Dashboard</h2>
            
            <section class="announcement-card">
                <div class="announcement-icon">📢</div>
                <div class="announcement-content">
                    <h3 class="announcement-title">Announcements!</h3>
                    <p class="announcement-text">Please do not forget to upload your grades for the current semester.</p>
                </div>
            </section>

            <!-- Add more dashboard cards/widgets here as needed -->

        </main>
    
    <footer>
        Copyright © ITSO Student Link 2025
    </footer>
</body>
</html>