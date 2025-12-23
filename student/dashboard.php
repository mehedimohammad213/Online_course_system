<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Student Dashboard</h2>
        <p>Welcome Student</p>

        <hr>

        <div class="dashboard-links">
            <a href="course_list.php">View Available Courses</a>
            <a href="my_courses.php">My Enrolled Courses</a>
            <a href="approved_courses.php">My Approved Courses</a>
        </div>

        <hr>

        <a href="../auth/logout.php">Logout</a>
    </div>
</body>
</html>
