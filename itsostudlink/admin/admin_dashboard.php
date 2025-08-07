<?php
session_start();

// Redirect if not logged in as an officer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: itso_login.php");
    exit();
}

$username = $_SESSION['user_username'] ?? 'Admin';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - ITSO Student Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles-admin-dashboard.css"> 
    

</head>
<body>
<button class="sidebar-toggle">☰</button>
    <div class="overlay"></div>
<div class="scontainer">
        <div class="sidebar">
            <h1>Admin Panel</h1>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="assign_subjects.php">Assign Subjects</a></li>
                <li><a href="students.php">Students</a></li>
                <li><a href="logout.php">Signout</a></li>
            </ul>
        </div>
        

        <div class="card">
        <div class="dashboard-content">
            <header class="dashboard-header">
                <span class="welcome-message">Welcome, <?= htmlspecialchars($username) ?></span>
            </header>
            <h2 class="page-title">Dashboard</h2>
            <p class="page-description">Welcome to the admin dashboard. Here you can manage faculty, subjects, and other system settings.</p>
            
            <section class="widget-grid">
                <div class="dashboard-card">
                    <h3 class="card-title">Manage Subject Assignments</h3>
                    <p class="card-description">Assign subjects to faculty members and manage class schedules.</p>
                    <a href="assign_subjects.php" class="card-link">Go to Assignments</a>
                </div>
        </div>
    </div>
</body>
</html>
