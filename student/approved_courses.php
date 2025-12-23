<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
?>

<h2>My Approved Courses</h2>

<?php
$sql = "SELECT c.course_id, c.course_title, c.description
        FROM enrollment_requests er
        JOIN courses c ON er.course_id = c.course_id
        WHERE er.student_id = $student_id
        AND er.request_status = 'approved'
        ORDER BY c.course_title";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "No approved courses found.";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<b>".$row['course_title']."</b><br>";
        echo $row['description']."<br>";
        echo "<hr>";
    }
}
?>

<br>
<a href="dashboard.php">Back to Dashboard</a>
