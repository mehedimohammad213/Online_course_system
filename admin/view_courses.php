<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>All Courses</h2>

<?php
$result = mysqli_query($conn, "SELECT * FROM courses");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<b>".$row['course_title']."</b><br>";
    echo $row['description']."<br>";
    echo "<a href='update_course.php?id=".$row['course_id']."'>Update</a> | ";
    echo "<a href='delete_course.php?id=".$row['course_id']."'>Delete</a>";
    echo "<hr>";
}
?>
