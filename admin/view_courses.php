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
    <title>All Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>All Courses</h2>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM courses ORDER BY created_at DESC");

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No courses found.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div style='margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;'>";
                echo "<h3>".$row['course_title']."</h3>";
                echo "<p>".$row['description']."</p>";
                echo "<div class='dashboard-links'>";
                echo "<a href='update_course.php?id=".$row['course_id']."'>Update</a>";
                echo "<a href='delete_course.php?id=".$row['course_id']."' onclick=\"return confirm('Are you sure you want to delete this course?')\">Delete</a>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
