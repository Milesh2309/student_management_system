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

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$course = $_POST['course'] ?? '';

if (empty($name) || empty($email) || empty($phone) || empty($course)) {
    die("All fields are required.");
}

// Use prepared statement to avoid SQL injection and errors
$stmt = $conn->prepare("INSERT INTO students (name, email, phone, course) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $course);

if ($stmt->execute()) {
    header("Location: index.php?message=Student added successfully");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
