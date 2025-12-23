<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

if (mysqli_query($conn, "DELETE FROM courses WHERE course_id=$id")) {
    header("Location: view_courses.php?msg=deleted");
} else {
    echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <a href="view_courses.php">Back to Courses</a>
    </div>
</body>
</html>
