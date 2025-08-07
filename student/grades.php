<?php
session_start();
require_once '../includes/db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'student') {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

try {
    // Fetch student grades with subject details
    $stmt = $pdo->prepare("
        SELECT 
            s.subject_name,
            s.subject_code,
            g.midterm_grade,
            g.finals_grade,
            g.status,
            c.year_level,
            c.section
        FROM grades g
        JOIN classes c ON g.class_id = c.id
        JOIN subjects s ON c.subject_id = s.id
        WHERE g.student_id = :student_id
        ORDER BY s.subject_name
    ");
    
    $stmt->execute([':student_id' => $student_id]);
    $grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    $error = "Error fetching grades: " . $e->getMessage();
}
require '../temp/studnav.php';
?>


        <h2>Your Grades</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="schedule">
            <?php if (empty($grades)): ?>
                <p>No grades available yet.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Subject Code</th>
                            <th>Midterm Grade</th>
                            <th>Finals Grade</th>
                            <th>Average</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grades as $grade): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($grade['subject_name']); ?></td>
                                <td><?php echo htmlspecialchars($grade['subject_code']); ?></td>
                                <td><?php echo htmlspecialchars($grade['midterm_grade'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($grade['finals_grade'] ?? 'N/A'); ?></td>
                                <td>
                                    <?php
                                    if (isset($grade['midterm_grade']) && isset($grade['finals_grade'])) {
                                        echo htmlspecialchars(($grade['midterm_grade'] + $grade['finals_grade']) / 2);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($grade['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <footer>
            Copyright © ITSO Student Link 2025
        </footer>
    </div>
</div>

<a href="#top" class="back-to-top">↑ Top</a>

<script src="script/script-index.js"></script>
</body>
</html>
