CREATE DATABASE IF NOT EXISTS student_management_system;
USE student_management_system;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Template INSERT statement for students
INSERT INTO students (name, email, phone, course) VALUES ('name_value', 'email_value', 'phone_value', 'course_value');

-- Template UPDATE statement for students
UPDATE students SET name='name_value', email='email_value', phone='phone_value', course='course_value' WHERE id=student_id;

-- Template DELETE statement for students
DELETE FROM students WHERE id=student_id;

-- Template INSERT statement for users
INSERT INTO users (name, email, password) VALUES ('name_value', 'email_value', 'hashed_password_value');

-- Template UPDATE statement for users
UPDATE users SET name='name_value', email='email_value', password='hashed_password_value' WHERE id=userid;

-- Template DELETE statement for users
DELETE FROM users WHERE id=userid;
