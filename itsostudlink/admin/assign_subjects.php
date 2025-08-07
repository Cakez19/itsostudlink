<?php
session_start();
require_once '../includes/db.php';


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
   
    header("Location: itso_login.php");
    exit();
}

try {
    $faculty_stmt = $pdo->query("SELECT id, username FROM faculty");
    $faculty_list = $faculty_stmt->fetchAll(PDO::FETCH_ASSOC);

    $subjects_stmt = $pdo->query("SELECT id, subject_code, subject_name FROM subjects");
    $subjects_list = $subjects_stmt->fetchAll(PDO::FETCH_ASSOC);

    $assignments_stmt = $pdo->query("
        SELECT c.id, f.username, s.subject_name, c.section, c.year_level, c.room, c.time
        FROM classes c
        JOIN faculty f ON c.faculty_id = f.id
        JOIN subjects s ON c.subject_id = s.id
        ORDER BY f.username, s.subject_name
    ");
    $assignments = $assignments_stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Subjects - ITSO Student Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles-admin-dashboard.css">
</head>
<body>
    <button class="sidebar-toggle">☰</button>
    <div class="overlay"></div>
    <div class="container">
        <div class="sidebar">
            <h1>Admin Panel</h1>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="assign_subjects.php">Assign Subjects</a></li>
                <li><a href="students.php">Students</a></li>
                <li><a href="../includes/logout.inc.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
            <h2>Assign Subject to Faculty</h2>

            <?php if (isset($_GET['success'])) : ?>
                <div class="success-message">Subject assigned successfully!</div>
            <?php elseif (isset($_GET['error'])) : ?>
                <div class="error-message">There was an error assigning the subject. <?php if (isset($_SESSION['assign_subject_error'])) { echo htmlspecialchars($_SESSION['assign_subject_error']); unset($_SESSION['assign_subject_error']); } ?></div>
            <?php endif; ?>

            <form action="../includes/assign_subjects.inc.php" method="POST" class="assign-form">
                <div class="form-group">
                    <label for="faculty">Faculty:</label>
                    <select name="faculty_id" id="faculty" required>
                        <option value="">Select Faculty</option>
                        <?php foreach ($faculty_list as $faculty) : ?>
                            <option value="<?= $faculty['id'] ?>"><?= htmlspecialchars($faculty['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="subject_id" id="subject" required>
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects_list as $subject) : ?>
                            <option value="<?= $subject['id'] ?>"><?= htmlspecialchars($subject['subject_name']) ?> (<?= htmlspecialchars($subject['subject_code']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <input type="text" name="section" id="section" placeholder="e.g., A, B, C" required>
                </div>
                <div class="form-group">
                    <label for="year_level">Year Level:</label>
                    <input type="number" name="year_level" id="year_level" placeholder="e.g., 1, 2, 3, 4" required min="1" max="4">
                </div>
                <div class="form-group">
                    <label for="room">Room:</label>
                    <input type="text" name="room" id="room" placeholder="e.g., Room 101" required>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="text" name="time" id="time" placeholder="e.g., 10:00 AM - 12:00 PM" required>
                </div>
                <button type="submit">Assign Subject</button>
            </form>

            <h2>Current Assignments</h2>
            <table class="assignments-table">
                <thead>
                    <tr>
                        <th>Faculty</th>
                        <th>Subject</th>
                        <th>Section</th>
                        <th>Year Level</th>
                        <th>Room</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($assignments)) : ?>
                        <tr>
                            <td colspan="7">No subjects have been assigned yet.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($assignments as $assignment) : ?>
                            <tr>
                                <td data-label="Faculty"><?= htmlspecialchars($assignment['username']) ?></td>
                                <td data-label="Subject"><?= htmlspecialchars($assignment['subject_name']) ?></td>
                                <td data-label="Section"><?= htmlspecialchars($assignment['section']) ?></td>
                                <td data-label="Year Level"><?= htmlspecialchars($assignment['year_level']) ?></td>
                                <td data-label="Room"><?= htmlspecialchars($assignment['room']) ?></td>
                                <td data-label="Time"><?= htmlspecialchars($assignment['time']) ?></td>
                                <td data-label="Action">
                                    <form action="../includes/delete_assignment.inc.php" method="POST">
                                        <input type="hidden" name="assignment_id" value="<?= $assignment['id'] ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="../script/sidebar-toggle.js"></script>
</html>