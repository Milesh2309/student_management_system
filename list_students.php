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

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    if ($student) {
        echo "<h2>Student Details</h2>";
        echo "<p>ID: " . htmlspecialchars($student['id']) . "</p>";
        echo "<p>Name: " . htmlspecialchars($student['name']) . "</p>";
        echo "<p>Email: " . htmlspecialchars($student['email']) . "</p>";
        echo "<p>Phone: " . htmlspecialchars($student['phone']) . "</p>";
        echo "<p>Course: " . htmlspecialchars($student['course']) . "</p>";
    } else {
        echo "Student not found.";
    }
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM students");
    if ($result->num_rows > 0) {
        echo "<h2>Student List</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['course']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }
}

$conn->close();
?>
