<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itsostudlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql = file_get_contents('db_updates.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    echo "Database updated successfully";
} else {
    echo "Error updating database: " . $conn->error;
}

$conn->close();
