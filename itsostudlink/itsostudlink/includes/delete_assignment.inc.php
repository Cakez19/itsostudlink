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

$assignment_id = $_POST['assignment_id'];

if (empty($assignment_id)) {
    header("Location: ../admin/assign_subjects.php?error=emptyfields");
    exit();
}

try {
    $pdo->beginTransaction();


    $stmt = $pdo->prepare("DELETE FROM student_schedule WHERE class_id = ?");
    $stmt->execute([$assignment_id]);

  
    $stmt = $pdo->prepare("DELETE FROM faculty_schedule WHERE class_id = ?");
    $stmt->execute([$assignment_id]);

   
    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->execute([$assignment_id]);

    $pdo->commit();

    header("Location: ../admin/assign_subjects.php?success=deleted");
    exit();
} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Error deleting assignment: " . $e->getMessage());
    header("Location: ../admin/assign_subjects.php?error=dberror");
    exit();
}
