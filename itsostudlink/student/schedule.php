<?php
session_start();
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

    <h2>Class Schedule</h2>

    <div class="schedule">
      <table>
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

    <footer>
      Copyright © ITSO Student Link 2025
    </footer>
  </div>
</div>

<script src="script/script-index.js"></script>
</body>
</html>
