<?php
session_start();
if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
}
?>

<h2>Instructor Dashboard</h2>
<p>Welcome Instructor</p>

<hr>

<a href="assigned_courses.php">My Assigned Courses</a><br><br>
<a href="../auth/logout.php">Logout</a>
