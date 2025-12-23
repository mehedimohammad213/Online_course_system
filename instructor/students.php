<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
}

$course_id = $_GET['id'];

$sql = "SELECT u.name, u.email
        FROM enrollment_requests er
        JOIN users u ON er.student_id = u.user_id
        WHERE er.course_id = $course_id
        AND er.request_status = 'approved'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "No approved students found.";
}

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['name']." - ".$row['email']."<br>";
}
?>

<br>
<a href="assigned_courses.php">Back</a>
