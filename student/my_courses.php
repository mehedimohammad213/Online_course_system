<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>My Courses</h2>

        <?php
        $sql = "SELECT c.course_title, er.request_status
                FROM enrollment_requests er
                JOIN courses c ON er.course_id = c.course_id
                WHERE er.student_id = $student_id
                ORDER BY er.created_at DESC";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>You haven't enrolled in any courses yet.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Course Title</th><th>Status</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $status_class = $row['request_status'] == 'approved' ? 'success' :
                               ($row['request_status'] == 'rejected' ? 'error' : '');
                echo "<tr>";
                echo "<td>".$row['course_title']."</td>";
                echo "<td><span class='$status_class'>".ucfirst($row['request_status'])."</span></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
