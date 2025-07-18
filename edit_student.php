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
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$course = $_POST['course'] ?? '';

if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($course)) {
    echo "All fields are required.";
    exit;
}

$stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, course=? WHERE id=?");
$stmt->bind_param("ssssi", $name, $email, $phone, $course, $id);

if ($stmt->execute()) {
    header("Location: index.php?message=Student updated successfully");
    exit;
} else {
    echo "Failed to update student.";
}

$stmt->close();
$conn->close();
?>
