<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faculty Dashboard - ITSO Student Link</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/styles-faculty.css">
</head>
<body>

<div class="container">
  <div class="sidebar">
    <button class="sidebar-toggle">☰</button>
    <div class="logo"><img src="../img/logo.png" alt="logo"></div>
    <h1>CCS FACULTY</h1>
    <ul id="sidebar-links">
      <li id="dashboard-link"><a href="faculty_dashboard.php">Dashboard</a></li>
      <li><a href="class-sched.php">Class Schedules</a></li>
      <li><a href="update_grades.php">Update Grades</a></li>
      <li id="signout-link"><a href="../includes/logout.inc.php">Signout</a></li>
    </ul>
  </div>

  <div class="main">
    <div class="topbar">
    <span><?php echo htmlspecialchars($_SESSION['username'] ?? 'Faculty'); ?></span>
      <img src="https://via.placeholder.com/32" alt="User Avatar">
    </div>
    <script src="../script/script-index.js"></script>