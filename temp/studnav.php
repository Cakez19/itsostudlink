<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ITSO Student Link</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/styles-index.css">
</head>
<body>

<div class="container">
  <div class="sidebar">
    <button class="sidebar-toggle">☰</button>
    <div class="logo"><img src="../img/logo.png" alt="logo"></div>
    <h1> ITSO STUDENT LINK</h1>
    <ul id="sidebar-links">
      <li id="dashboard-link"><a href="index.php">Dashboard</a></li>
      <li><a href="grades.php">Grades</a></li>
      <li><a href="schedule.php">Class Schedule</a></li>
      <li><a href="announcements.php">Announcements</a></li>
      <li id="signout-link"><a href="../includes/logout.inc.php">Signout</a></li>
    </ul>
  </div>

  <div class="main">
    <div class="topbar">
    <span><?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?></span>
      <img src="https://via.placeholder.com/32" alt="User Avatar">
    </div>
    <script src="../script/script-index.js"></script>