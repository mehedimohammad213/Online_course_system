<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Admin Dashboard</h2>
<p>Welcome Admin</p>

<hr>

<h3>Course Management</h3>
<a href="add_course.php">Add Course</a><br>
<a href="view_courses.php">View / Update / Delete Courses</a><br><br>

<h3>User & Enrollment Management</h3>
<a href="approve_students.php">Approve Students</a><br>
<a href="approve_instructors.php">Approve Instructors</a><br>
<a href="view_students.php">View All Students</a><br>
<a href="view_instructors.php">View All Instructors</a><br>
<a href="enrollment_requests.php">Approve Enrollments</a><br>
<a href="assign_instructor.php">Assign Instructor</a><br><br>

<a href="../auth/logout.php">Logout</a>
