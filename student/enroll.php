<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
}

$student_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

mysqli_query($conn,
    "INSERT INTO enrollment_requests (student_id, course_id, request_status)
     VALUES ($student_id, $course_id, 'pending')"
);

echo "Enrollment request sent successfully.<br>";
echo "<a href='course_list.php'>Back to Courses</a>";
?>
