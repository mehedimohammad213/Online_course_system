<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
}

$student_id = $_SESSION['user_id'];
?>

<h2>Available Courses</h2>

<?php
$sql = "SELECT * FROM courses WHERE status='active'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<b>".$row['course_title']."</b><br>";
    echo $row['description']."<br>";
    echo "<a href='enroll.php?id=".$row['course_id']."'>Enroll</a>";
    echo "<hr>";
}
?>

<a href="dashboard.php">Back to Dashboard</a>
