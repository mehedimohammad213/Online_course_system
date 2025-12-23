<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Enrollment Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Enrollment Requests</h2>

        <?php
        $sql = "SELECT er.request_id, u.name, c.course_title
                FROM enrollment_requests er
                JOIN users u ON er.student_id = u.user_id
                JOIN courses c ON er.course_id = c.course_id
                WHERE er.request_status = 'pending'
                ORDER BY er.created_at DESC";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No pending enrollment requests.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Student Name</th><th>Course</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['course_title']."</td>";
                echo "<td>";
                echo "<a href='approve_enrollment.php?id=".$row['request_id']."'>Approve</a> | ";
                echo "<a href='reject_enrollment.php?id=".$row['request_id']."'>Reject</a>";
                echo "</td>";
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
