<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
}

$student_id = $_SESSION['user_id'];
?>

<h2>My Courses</h2>

<?php
$sql = "SELECT c.course_title, er.request_status
        FROM enrollment_requests er
        JOIN courses c ON er.course_id = c.course_id
        WHERE er.student_id = $student_id";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['course_title']." - ";
    echo "<b>".$row['request_status']."</b><br>";
}
?>

<br>
<a href="dashboard.php">Back to Dashboard</a>
