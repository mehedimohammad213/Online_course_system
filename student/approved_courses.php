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
    <title>My Approved Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
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
            echo "<p>No approved courses found.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div style='margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;'>";
                echo "<h3>".$row['course_title']."</h3>";
                echo "<p>".$row['description']."</p>";
                echo "</div>";
            }
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
