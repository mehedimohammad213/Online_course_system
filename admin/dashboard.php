<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Welcome Admin</p>

        <hr>

        <h3>Course Management</h3>
        <div class="dashboard-links">
            <a href="add_course.php">Add Course</a>
            <a href="view_courses.php">View / Update / Delete Courses</a>
        </div>

        <hr>

        <h3>User & Enrollment Management</h3>
        <div class="dashboard-links">
            <a href="approve_students.php">Approve Students</a>
            <a href="approve_instructors.php">Approve Instructors</a>
            <a href="view_students.php">View All Students</a>
            <a href="view_instructors.php">View All Instructors</a>
            <a href="enrollment_requests.php">Approve Enrollments</a>
            <a href="assign_instructor.php">Assign Instructor</a>
        </div>

        <hr>

        <a href="../auth/logout.php">Logout</a>
    </div>
</body>
</html>
