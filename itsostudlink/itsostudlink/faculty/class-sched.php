<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/db.php';

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../faculty_login.php");
    die();
}
$faculty_id = $_SESSION['faculty_id'];
$username = $_SESSION['username'];

// Fetch schedule
$query = $pdo->prepare("
    SELECT s.subject_name, c.room, c.year_level, c.section, c.time
    FROM classes c
    JOIN subjects s ON c.subject_id = s.id
    WHERE c.faculty_id = ?
    ORDER BY c.time
");
$query->execute([$faculty_id]);
$schedule = $query->fetchAll(PDO::FETCH_ASSOC);

require '../temp/facnav.php';
?>
<link rel="stylesheet" href="../styles/styles-faculty.css">

    <h2>Class Schedule</h2>

    <div class="schedule">
      <table>
        <thead>
          <tr>
            <th>Course</th>
            <th>Room</th>
            <th>Year & Section</th>
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
                <td><?= htmlspecialchars($class['year_level'] . '-' . $class['section']) ?></td>
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
