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
    <title>Available Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Available Courses</h2>

        <?php
        $sql = "SELECT * FROM courses WHERE status='active'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No courses available at the moment.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div style='margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;'>";
                echo "<h3>".$row['course_title']."</h3>";
                echo "<p>".$row['description']."</p>";
                echo "<a href='enroll.php?id=".$row['course_id']."'>Enroll</a>";
                echo "</div>";
            }
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
