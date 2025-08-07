<?php
require_once '../includes/db.php';
require_once '../includes/school_year.inc.php';


$year_level = isset($_GET['year_level']) ? $_GET['year_level'] : '';
$section = isset($_GET['section']) ? $_GET['section'] : '';


$query = "SELECT * FROM student";
$params = [];

if ($year_level || $section) {
    $query .= " WHERE";
    if ($year_level) {
        $query .= " year_level = :year_level";
        $params[':year_level'] = $year_level;
    }
    if ($section) {
        if ($year_level) {
            $query .= " AND";
        }
        $query .= " section = :section";
        $params[':section'] = $section;
    }
}

$query .= " ORDER BY year_level, section";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT * FROM school_year WHERE is_active = 1";
$school_year = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Students</title>
    <link rel="stylesheet" href="../styles/styles-students.css">
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
                <li><a href="../includes/logout.inc.php">Logout</a></li>
            </ul>
        </div>
    <div class="container">
        <div class="header">
            <h1>Students</h1>
            <div class="school-year-container">
                <h2>School Year: <?php echo $school_year['school_year']; ?></h2>
                <form action="update_school_year.php" method="post">
                    <input type="text" name="school_year" id="school_year" value="<?php echo $school_year['school_year']; ?>">
                    <button type="submit" id="submit">Update</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header1">
                <h3>Filter Students</h3>
            </div>
            <div class="card-body">
                <form action="students.php" method="get" class="filter-form">
                    <div class="form-group">
                        <label for="year_level">Year Level</label>
                        <select name="year_level" id="year_level">
                            <option value="">All</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <select name="section" id="section">
                            <option value="">All</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">Filter</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header2">
                <h3>Student List</h3>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Student's Name</>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Year Level</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo $student['studentnum']; ?></td>
                                    <td><?php echo $student['firstname'], ' ', $student['lastname']; ?></td>
                                    <td><?php echo $student['username']; ?></td>
                                    <td><?php echo $student['email']; ?></td>
                                    <td><?php echo $student['year_level']; ?></td>
                                    <td><?php echo $student['section']; ?></td>
                                    <td><span class="status-<?php echo isset($student['status']) ? strtolower($student['status']) : 'unknown'; ?>"><?php echo isset($student['status']) ? $student['status'] : 'N/A'; ?></span></td>
                                    <td class="action-links">
                                        <?php if (isset($student['status']) && strtolower($student['status']) !== 'verified'): ?>
                                            <a href="verify_student.php?id=<?php echo $student['id']; ?>" class="btn-verify">Verify</a>
                                        <?php endif; ?>
                                        <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn-delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../script/sidebar-toggle.js"></script>
</html>
