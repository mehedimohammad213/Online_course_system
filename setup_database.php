<?php
// Database setup script - creates tables and adds 5 sample data entries

include("config/db.php");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error() . "\nPlease start MySQL first: sudo systemctl start mysql\n");
}

echo "Connected to database successfully!\n\n";

// Create tables
echo "Creating tables...\n";

$tables = [
    "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'student', 'instructor') NOT NULL,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS courses (
        course_id INT AUTO_INCREMENT PRIMARY KEY,
        course_title VARCHAR(200) NOT NULL,
        description TEXT,
        instructor_id INT,
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (instructor_id) REFERENCES users(user_id) ON DELETE SET NULL
    )",

    "CREATE TABLE IF NOT EXISTS enrollment_requests (
        request_id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT NOT NULL,
        course_id INT NOT NULL,
        request_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
        FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
        UNIQUE KEY unique_enrollment (student_id, course_id)
    )",

    "CREATE TABLE IF NOT EXISTS materials (
        material_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        title VARCHAR(200) NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS notices (
        notice_id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        title VARCHAR(200) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
    )"
];

foreach ($tables as $table) {
    if (mysqli_query($conn, $table)) {
        echo "✓ Table created successfully\n";
    } else {
        echo "✗ Error creating table: " . mysqli_error($conn) . "\n";
    }
}

echo "\nInserting 5 sample data entries...\n";

// 1. Admin user
$sql1 = "INSERT INTO users (name, email, password, role, status)
         VALUES ('Admin User', 'admin@learnplus.com', 'admin123', 'admin', 'approved')
         ON DUPLICATE KEY UPDATE name=name";
if (mysqli_query($conn, $sql1)) {
    echo "✓ 1. Admin user inserted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

// 2. Student user
$sql2 = "INSERT INTO users (name, email, password, role, status)
         VALUES ('John Student', 'john.student@example.com', 'student123', 'student', 'approved')
         ON DUPLICATE KEY UPDATE name=name";
if (mysqli_query($conn, $sql2)) {
    echo "✓ 2. Student user inserted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

// 3. Instructor user
$sql3 = "INSERT INTO users (name, email, password, role, status)
         VALUES ('Dr. Sarah Instructor', 'sarah.instructor@example.com', 'instructor123', 'instructor', 'approved')
         ON DUPLICATE KEY UPDATE name=name";
if (mysqli_query($conn, $sql3)) {
    echo "✓ 3. Instructor user inserted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

// 4. Course
$result = mysqli_query($conn, "SELECT user_id FROM users WHERE email = 'sarah.instructor@example.com' LIMIT 1");
$instructor = mysqli_fetch_assoc($result);
$instructor_id = $instructor['user_id'] ?? null;

$sql4 = "INSERT INTO courses (course_title, description, instructor_id, status)
         VALUES ('Introduction to Web Development', 'Learn HTML, CSS, and JavaScript fundamentals for building modern websites.', '$instructor_id', 'active')
         ON DUPLICATE KEY UPDATE course_title=course_title";
if (mysqli_query($conn, $sql4)) {
    echo "✓ 4. Course inserted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

// 5. Enrollment request
$result = mysqli_query($conn, "SELECT user_id FROM users WHERE email = 'john.student@example.com' LIMIT 1");
$student = mysqli_fetch_assoc($result);
$student_id = $student['user_id'] ?? null;

$result = mysqli_query($conn, "SELECT course_id FROM courses WHERE course_title = 'Introduction to Web Development' LIMIT 1");
$course = mysqli_fetch_assoc($result);
$course_id = $course['course_id'] ?? null;

$sql5 = "INSERT INTO enrollment_requests (student_id, course_id, request_status)
         VALUES ('$student_id', '$course_id', 'approved')
         ON DUPLICATE KEY UPDATE request_status='approved'";
if (mysqli_query($conn, $sql5)) {
    echo "✓ 5. Enrollment request inserted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

echo "\n=== Setup Complete ===\n";
echo "Verifying data...\n\n";

// Verify data
$users = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
$user_count = mysqli_fetch_assoc($users)['count'];
echo "Total users: $user_count\n";

$courses = mysqli_query($conn, "SELECT COUNT(*) as count FROM courses");
$course_count = mysqli_fetch_assoc($courses)['count'];
echo "Total courses: $course_count\n";

$enrollments = mysqli_query($conn, "SELECT COUNT(*) as count FROM enrollment_requests");
$enrollment_count = mysqli_fetch_assoc($enrollments)['count'];
echo "Total enrollments: $enrollment_count\n";

mysqli_close($conn);
?>
