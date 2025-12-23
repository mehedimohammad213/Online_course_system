<?php
session_start();
if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
}
?>

<h2>Student Dashboard</h2>
<p>Welcome Student</p>

<hr>

<a href="course_list.php">View Available Courses</a><br><br>
<a href="my_courses.php">My Enrolled Courses</a><br><br>
<a href="approved_courses.php">My Approved Courses</a><br><br>

<a href="../auth/logout.php">Logout</a>
