<?php
require 'db.php';

// Create database and table if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS student_management_system");
$conn->query("USE student_management_system");
$conn->query("CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL
)");

$id = $_POST['id'] ?? '';

if (empty($id)) {
    echo "ID is required.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM students WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?message=Student deleted successfully");
    exit;
} else {
    echo "Failed to delete student.";
}

$stmt->close();
$conn->close();
?>
