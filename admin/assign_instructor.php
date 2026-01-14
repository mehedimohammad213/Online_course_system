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
    <title>Assign Instructor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Assign Instructor</h2>

        <form method="post">
            Course: <br>
            <select name="course_id" required>
                <option value="">Select Course</option>
                <?php
                $courses = mysqli_query($conn, "SELECT course_id, course_title FROM courses ORDER BY course_title");
                while ($course = mysqli_fetch_assoc($courses)) {
                    echo "<option value='".$course['course_id']."'>".$course['course_title']."</option>";
                }
                ?>
            </select><br><br>

            Instructor: <br>
            <select name="instructor_id" required>
                <option value="">Select Instructor</option>
                <?php
                $instructors = mysqli_query($conn, "SELECT user_id, name FROM users WHERE role='instructor' AND status='approved' ORDER BY name");
                while ($instructor = mysqli_fetch_assoc($instructors)) {
                    echo "<option value='".$instructor['user_id']."'>".$instructor['name']."</option>";
                }
                ?>
            </select><br><br>

            <input type="submit" name="assign" value="Assign Instructor">
        </form>

        <?php
        if (isset($_POST['assign'])) {
            $course_id = $_POST['course_id'];
            $instructor_id = $_POST['instructor_id'];

            if (empty($course_id) || empty($instructor_id) || !is_numeric($course_id) || !is_numeric($instructor_id)) {
                echo "<div class='error'>Please select both a course and an instructor.</div>";
            } else {
                if (mysqli_query($conn, "UPDATE courses
                                         SET instructor_id=$instructor_id
                                         WHERE course_id=$course_id")) {
                    echo "<div class='success'>Instructor Assigned Successfully</div>";
                } else {
                    echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }
        }
        ?>

        <br>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
