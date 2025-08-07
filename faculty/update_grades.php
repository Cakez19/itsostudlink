<?php
session_start();
require_once '../includes/db.php';

// Check if the user is logged in and is a faculty member
if (!isset($_SESSION['faculty_id'])) {
    header("Location: ../faculty_login.php");
    exit();
}

$faculty_id = $_SESSION['faculty_id'];
$username = $_SESSION['username']; 

// Handle messages
$upload_message = '';
$upload_error = '';

if (isset($_SESSION['upload_success'])) {
    $upload_message = $_SESSION['upload_success'];
    unset($_SESSION['upload_success']);
}

if (isset($_SESSION['upload_error'])) {
    $upload_error = $_SESSION['upload_error'];
    unset($_SESSION['upload_error']);
}

try {
    // Fetch classes assigned to the faculty
    $query = $pdo->prepare("
        SELECT c.id AS class_id, s.subject_code, s.subject_name, c.section, c.year_level,
               COUNT(DISTINCT g.student_id) as grades_count
        FROM classes c
        JOIN subjects s ON c.subject_id = s.id
        LEFT JOIN grades g ON c.id = g.class_id
        WHERE c.faculty_id = ?
        GROUP BY c.id, s.subject_code, s.subject_name, c.section, c.year_level
        ORDER BY s.subject_name, c.section
    ");
    $query->execute([$faculty_id]);
    $classes = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching classes: " . $e->getMessage());
}

require '../temp/facnav.php';
?>
<link rel="stylesheet" href="../styles/styles-faculty.css">

    <h2>UPDATE GRADES</h2>

    <?php if ($upload_message): ?>
        <div class="success-message"><?= htmlspecialchars($upload_message) ?></div>
    <?php endif; ?>

    <?php if ($upload_error): ?>
        <div class="error-message"><?= htmlspecialchars($upload_error) ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['upload_errors']) && !empty($_SESSION['upload_errors'])): ?>
        <div class="warning-message">
            <strong>Upload Warnings:</strong>
            <ul>
                <?php foreach ($_SESSION['upload_errors'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['upload_errors']); ?>
    <?php endif; ?>
    <div class="upload-instructions">
            <h3>Upload Instructions</h3>
            <p>Your Excel file should have the following format:</p>
            <ul>
                <li><strong>Column A:</strong> Student Number</li>
                <li><strong>Column B:</strong> Student's Name</li>
                <li><strong>Column D:</strong> Midterm Grade</li>
                <li><strong>Column E:</strong> Finals Grade (if applicable)</li>
                <li><strong>Column F:</strong> Status (e.g., Passed, Failed, INC)</li>
                <li><strong>Row 1:</strong> Header row (will be skipped)</li>
            </ul>
            <p><strong>Example:</strong></p>
            <table class="example-table">
                <tr><th>Student Number</th><th>Student Name</th><th>Midterm Grade</th><th>Finals Grade</th><th>Status</th></tr>
                <tr><td>22-0216</td><td>John Doe</td><td>2.0</td><td>1.5</td><td>Passed</td></tr>
                <tr><td>22-0217</td><td>Jane Smith</td><td>1.4</td><td>1.0</td><td>Passed</td></tr>
            </table>
        </div>
    <div class="form-container">
       
        <?php if (!empty($classes)): ?>
            <?php foreach ($classes as $class): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($class['subject_name']) ?> (<?= htmlspecialchars($class['subject_code']) ?>)</h3>
                    <p>Section: <?= htmlspecialchars($class['section']) ?> - Year: <?= htmlspecialchars($class['year_level']) ?></p>
                    <p>Current grades uploaded: <?= $class['grades_count'] ?></p>
                    
                    <form method="POST" enctype="multipart/form-data" action="process_grades_upload.php">
                        <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">
                        <div class="input-group">
                            <label for="gradefile-<?= $class['class_id'] ?>" class="custom-file-upload">
                                Choose Excel File (.xlsx, .xls):
                            </label>
                            <input type="file" 
                                   id="gradefile-<?= $class['class_id'] ?>" 
                                   name="gradefile" 
                                   accept=".xlsx,.xls" 
                                   required
                                   onchange="updateFileName(this)">
                            <span class="file-name" id="filename-<?= $class['class_id'] ?>"></span>
                        </div>
                        <button type="submit" name="upload_grades">Upload Grades</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No classes assigned yet.</p>
        <?php endif; ?>
    </div>

    <footer>
        Copyright © ITSO Student Link 2025
    </footer>
  </div>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name || 'No file selected';
    const classId = input.id.replace('gradefile-', '');
    document.getElementById('filename-' + classId).textContent = fileName;
}
</script>

</body>
</html>
