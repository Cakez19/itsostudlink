<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/db.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $file = $_FILES['gradefile'];

    $updated_count = 0;
    $inserted_count = 0;
    $skipped_count = 0;
    $errors_list = [];

    // Basic file validation
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['upload_error'] = "File upload error: " . $file['error'];
        header("Location: update_grades.php");
        exit();
    }

    try {
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $worksheet = $spreadsheet->getActiveSheet();

        // Process grades, starting from row 24 as per the ROG.xlsx template
        $highestRow = $worksheet->getHighestRow();
        for ($row = 24; $row <= $highestRow; ++$row) {
            $student_number = $worksheet->getCell('F' . $row)->getValue();
            $lastname = $worksheet->getCell('B' . $row)->getValue();
            $firstname = $worksheet->getCell('D' . $row)->getValue();
            $midterm_grade = $worksheet->getCell('G' . $row)->getValue();
            $finals_grade = $worksheet->getCell('H' . $row)->getValue();
            $remarks = $worksheet->getCell('L' . $row)->getValue(); // Assuming merged L and M cells value is in L

            // Skip empty rows (based on student number)
            if (empty($student_number)) {
                $skipped_count++;
                continue;
            }

            // Get student ID from student number
            $query = "SELECT id FROM student WHERE studentnum = :studentnum";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':studentnum', $student_number);
            $stmt->execute();
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
                $student_id = $student['id'];

                // Check if a grade record already exists
                $query = "SELECT id FROM grades WHERE student_id = :student_id AND class_id = :class_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':student_id', $student_id);
                $stmt->bindParam(':class_id', $class_id);
                $stmt->execute();
                $grade_exists = $stmt->fetch();

                if ($grade_exists) {
                    // Update existing grade
                    $query = "UPDATE grades SET midterm_grade = :midterm_grade, finals_grade = :finals_grade, status = :status WHERE student_id = :student_id AND class_id = :class_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':midterm_grade', $midterm_grade);
                    $stmt->bindParam(':finals_grade', $finals_grade);
                    $stmt->bindParam(':status', $remarks);
                    $stmt->bindParam(':student_id', $student_id);
                    $stmt->bindParam(':class_id', $class_id);
                    $stmt->execute();
                    $updated_count++;
                } else {
                    // Insert new grade
                    $query = "INSERT INTO grades (student_id, class_id, midterm_grade, finals_grade, status) VALUES (:student_id, :class_id, :midterm_grade, :finals_grade, :status)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':midterm_grade', $midterm_grade);
                    $stmt->bindParam(':finals_grade', $finals_grade);
                    $stmt->bindParam(':status', $remarks);
                    $stmt->bindParam(':student_id', $student_id);
                    $stmt->bindParam(':class_id', $class_id);
                    $stmt->execute();
                    $inserted_count++;
                }
            } else {
                $errors_list[] = "Student with Student Number '{$student_number}' (Name: {$lastname}, {$firstname}) not found in the database.";
            }
        }

        $_SESSION['upload_success'] = "Grade upload complete. " . $updated_count . " records updated, " . $inserted_count . " records inserted.";
        if (!empty($errors_list)) {
            $_SESSION['upload_errors'] = $errors_list;
        }

    } catch (Exception $e) {
        $_SESSION['upload_error'] = "An error occurred during file processing: " . $e->getMessage();
    }

    header("Location: update_grades.php");
    exit();
}
?>