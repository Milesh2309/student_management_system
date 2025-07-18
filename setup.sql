-- Create database
-- CREATE DATABASE IF NOT EXISTS student_management_system;
-- USE student_management_system;

-- Create students table
CREATE TABLE IF NOT EXISTS  student_management_system (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL
);
