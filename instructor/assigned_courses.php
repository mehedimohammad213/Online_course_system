<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
}

$instructor_id = $_SESSION['user_id'];
?>

<h2>My Assigned Courses</h2>

<?php
$result = mysqli_query($conn,
    "SELECT * FROM courses WHERE instructor_id=$instructor_id"
);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<b>".$row['course_title']."</b><br>";
    echo $row['description']."<br>";
    echo "<a href='students.php?id=".$row['course_id']."'>View Students</a> | ";
    echo "<a href='upload_material.php?id=".$row['course_id']."'>Upload Material</a> | ";
    echo "<a href='update_course.php?id=".$row['course_id']."'>Update Course</a><br><br>";
}
?>
