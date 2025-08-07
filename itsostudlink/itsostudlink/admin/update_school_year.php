<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $school_year = $_POST['school_year'];

    // Deactivate all school years
    $query = "UPDATE school_year SET is_active = 0";
    $pdo->query($query);

    // Activate or create the new school year
    $query = "SELECT * FROM school_year WHERE school_year = :school_year";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['school_year' => $school_year]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $query = "UPDATE school_year SET is_active = 1 WHERE school_year = :school_year";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['school_year' => $school_year]);
    } else {
        $query = "INSERT INTO school_year (school_year, is_active) VALUES (:school_year, 1)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['school_year' => $school_year]);
    }

    header('Location: students.php');
}
