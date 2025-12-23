<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
    exit();
}

$instructor_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Assigned Courses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>My Assigned Courses</h2>

        <?php
        $result = mysqli_query($conn,
            "SELECT * FROM courses WHERE instructor_id=$instructor_id"
        );

        if (mysqli_num_rows($result) == 0) {
            echo "<p>No courses assigned yet.</p>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div style='margin: 20px 0; padding: 15px; background: #f9f9f9; border-radius: 5px;'>";
                echo "<h3>".$row['course_title']."</h3>";
                echo "<p>".$row['description']."</p>";
                echo "<div class='dashboard-links'>";
                echo "<a href='students.php?id=".$row['course_id']."'>View Students</a>";
                echo "<a href='upload_material.php?id=".$row['course_id']."'>Upload Material</a>";
                echo "<a href='upload_notice.php?id=".$row['course_id']."'>Upload Notice</a>";
                echo "<a href='update_course.php?id=".$row['course_id']."'>Update Course</a>";
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
