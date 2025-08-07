<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/db.php';
require_once '../includes/school_year.inc.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    die();
}
$username = $_SESSION['user_username'];
require_once '../includes/db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch student info
$student_query = $pdo->prepare("SELECT year_level, section FROM student WHERE id = ?");
$student_query->execute([$student_id]);
$student = $student_query->fetch(PDO::FETCH_ASSOC);

// Get current school year
$query = "SELECT * FROM school_year WHERE is_active = 1";
$school_year = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

// Fetch schedule
$query = $pdo->prepare("
    SELECT s.subject_name, c.room, f.username AS instructor_name, c.time
    FROM classes c
    JOIN subjects s ON c.subject_id = s.id
    JOIN faculty f ON c.faculty_id = f.id
    WHERE c.year_level = ? AND c.section = ?
    ORDER BY c.time
");
$query->execute([$student['year_level'], $student['section']]);
$schedule = $query->fetchAll(PDO::FETCH_ASSOC);

require '../temp/studnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard - ITSO Student Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css"> 
</head>
<body>
        <div class="main">
        <main class="dashboard-content">
            <header class="dashboard-header">
                <span class="welcome-message">Welcome, <?= htmlspecialchars(strtoupper($username)) ?>!</span>
                <span class="school-year">S.Y.: <?= htmlspecialchars($school_year['school_year']) ?></span>
            </header></span>
            <h2 class="page-title">Dashboard</h2>

           
                <h3 class="section-title">Your Schedule</h3>
                <div class="schedule">
                    <table >
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Room</th>
                                <th>Instructor</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($schedule)): ?>
                                <tr>
                                    <td colspan="4">No classes scheduled.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($schedule as $class): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($class['subject_name']) ?></td>
                                        <td><?= htmlspecialchars($class['room']) ?></td>
                                        <td><?= htmlspecialchars($class['instructor_name']) ?></td>
                                        <td><?= htmlspecialchars($class['time']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
               

            <section class="announcement-card">
                <div class="announcement-icon">📢</div>
                <div class="announcement-content">
                    <h3 class="announcement-title">Announcements!</h3>
                    <p class="announcement-text">General Cleaning On Friday</p>
                </div>
            </section>

        </main>
    </div>
    <footer>
        Copyright © ITSO Student Link 2025
    </footer>
</body>
</html>