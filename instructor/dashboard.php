<?php
session_start();
if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Instructor Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Instructor Dashboard</h2>
        <p>Welcome Instructor</p>

        <hr>

        <div class="dashboard-links">
            <a href="assigned_courses.php">My Assigned Courses</a>
        </div>

        <hr>

        <a href="../auth/logout.php">Logout</a>
    </div>
</body>
</html>
