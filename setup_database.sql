-- Create database if not exists
CREATE DATABASE IF NOT EXISTS online_course_db;
USE online_course_db;

-- Users table (Admin, Student, Instructor)
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student', 'instructor') NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE IF NOT EXISTS courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_title VARCHAR(200) NOT NULL,
    description TEXT,
    instructor_id INT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (instructor_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Enrollment requests table
CREATE TABLE IF NOT EXISTS enrollment_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    request_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (student_id, course_id)
);

-- Course materials table
CREATE TABLE IF NOT EXISTS materials (
    material_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Course notices table
CREATE TABLE IF NOT EXISTS notices (
    notice_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Insert 5 sample data entries

-- 1. Admin user
INSERT INTO users (name, email, password, role, status)
VALUES ('Admin User', 'admin@learnplus.com', 'admin123', 'admin', 'approved')
ON DUPLICATE KEY UPDATE name=name;

-- 2. Student user
INSERT INTO users (name, email, password, role, status)
VALUES ('John Student', 'john.student@example.com', 'student123', 'student', 'approved')
ON DUPLICATE KEY UPDATE name=name;

-- 3. Instructor user
INSERT INTO users (name, email, password, role, status)
VALUES ('Dr. Sarah Instructor', 'sarah.instructor@example.com', 'instructor123', 'instructor', 'approved')
ON DUPLICATE KEY UPDATE name=name;

-- 4. Course (assuming instructor_id will be set after instructor is created)
SET @instructor_id = (SELECT user_id FROM users WHERE email = 'sarah.instructor@example.com' LIMIT 1);
INSERT INTO courses (course_title, description, instructor_id, status)
VALUES ('Introduction to Web Development', 'Learn HTML, CSS, and JavaScript fundamentals for building modern websites.', @instructor_id, 'active')
ON DUPLICATE KEY UPDATE course_title=course_title;

-- 5. Enrollment request (student enrolling in course)
SET @student_id = (SELECT user_id FROM users WHERE email = 'john.student@example.com' LIMIT 1);
SET @course_id = (SELECT course_id FROM courses WHERE course_title = 'Introduction to Web Development' LIMIT 1);
INSERT INTO enrollment_requests (student_id, course_id, request_status)
VALUES (@student_id, @course_id, 'approved')
ON DUPLICATE KEY UPDATE request_status='approved';
