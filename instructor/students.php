<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
    exit();
}

$instructor_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

// Check if instructor is assigned to this course
$check = mysqli_query($conn,
    "SELECT * FROM courses WHERE course_id=$course_id AND instructor_id=$instructor_id"
);

if (mysqli_num_rows($check) == 0) {
    echo "You are not assigned to this course.";
    exit();
}

$sql = "SELECT u.name, u.email
        FROM enrollment_requests er
        JOIN users u ON er.student_id = u.user_id
        WHERE er.course_id = $course_id
        AND er.request_status = 'approved'
        ORDER BY u.name";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Approved Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Approved Students</h2>

        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<p>No approved students found for this course.</p>";
        } else {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>

        <br>
        <a href="assigned_courses.php">Back to Assigned Courses</a>
    </div>
</body>
</html>
