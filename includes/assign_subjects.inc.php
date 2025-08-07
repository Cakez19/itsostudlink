<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin/assign_subjects.php");
    exit();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$faculty_id = $_POST['faculty_id'];
$subject_id = $_POST['subject_id'];
$section = trim($_POST['section']);
$year_level = trim($_POST['year_level']);
$room = trim($_POST['room']);
$time = trim($_POST['time']);

if (empty($faculty_id) || empty($subject_id) || empty($section) || empty($year_level) || empty($room) || empty($time)) {
    header("Location: ../admin/assign_subjects.php?error=emptyfields");
    exit();
}

try {
    $pdo->beginTransaction();

    // Get the active school year ID
    $stmt_school_year = $pdo->prepare("SELECT id FROM school_year WHERE is_active = 1 LIMIT 1");
    $stmt_school_year->execute();
    $active_school_year = $stmt_school_year->fetch(PDO::FETCH_ASSOC);

    if (!$active_school_year) {
        throw new PDOException("No active school year found. Please set an active school year in the admin panel.");
    }
    $school_year_id = $active_school_year['id'];

    $stmt = $pdo->prepare("INSERT INTO classes (faculty_id, subject_id, section, year_level, room, time, school_year_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$faculty_id, $subject_id, $section, $year_level, $room, $time, $school_year_id]);
    $class_id = $pdo->lastInsertId();

    // Find students in the given year and section
    $stmt = $pdo->prepare("SELECT id FROM student WHERE year_level = ? AND section = ?");
    $stmt->execute([$year_level, $section]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create schedule for each student
    $stmt = $pdo->prepare("INSERT INTO student_schedule (student_id, class_id, room, time) VALUES (?, ?, ?, ?)");
    foreach ($students as $student) {
        $stmt->execute([$student['id'], $class_id, $room, $time]);
    }

    // Create schedule for the faculty
    $stmt = $pdo->prepare("INSERT INTO faculty_schedule (faculty_id, class_id, room, time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$faculty_id, $class_id, $room, $time]);

    $pdo->commit();

    header("Location: ../admin/assign_subjects.php?success=1");
    exit();
} catch (PDOException $e) {
    $pdo->rollBack();
    $_SESSION['assign_subject_error'] = $e->getMessage();
    error_log("Error assigning subject: " . $e->getMessage());
    header("Location: ../admin/assign_subjects.php?error=dberror");
    exit();
}

