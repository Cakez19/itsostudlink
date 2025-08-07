<?php
require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "UPDATE student SET status = 'verified' WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    header('Location: students.php');
}
