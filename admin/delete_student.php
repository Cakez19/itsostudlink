<?php
require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo->beginTransaction();

        // Delete from student_schedule table first
        $query_schedule = "DELETE FROM student_schedule WHERE student_id = :id";
        $stmt_schedule = $pdo->prepare($query_schedule);
        $stmt_schedule->execute(['id' => $id]);

        // Then delete from grades table
        $query_grades = "DELETE FROM grades WHERE student_id = :id";
        $stmt_grades = $pdo->prepare($query_grades);
        $stmt_grades->execute(['id' => $id]);

        // Finally, delete the student
        $query_student = "DELETE FROM student WHERE id = :id";
        $stmt_student = $pdo->prepare($query_student);
        $stmt_student->execute(['id' => $id]);

        $pdo->commit();

        header('Location: students.php?message=Student deleted successfully');
    } catch (PDOException $e) {
        $pdo->rollBack();
        // Log error or show a user-friendly message
        header('Location: students.php?error=Could not delete student. ' . $e->getMessage());
    }
}